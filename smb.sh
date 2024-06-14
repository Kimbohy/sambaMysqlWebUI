#!/bin/bash

# Variables
mysql_user="kim"
mysql_password="kimbohy"
mysql_db="authentication"
sambaPath="/var/samba"

# Interroger MySQL pour obtenir les informations sur les utilisateurs
mysql_query=$(mysql -u"$mysql_user" -p"$mysql_password" "$mysql_db" -se "SELECT login FROM users" 2>/dev/null | tail -n +1)

# Parcourir chaque utilisateur renvoyé par la requête
for user in $mysql_query; do
    # Vérifier si l'utilisateur a déjà un compte Samba
    if ! pdbedit -L -v | grep -q "Unix username: * $user"; then
        # Mettre à jour la base de données des utilisateurs Samba
        group=$(mysql -u"$mysql_user" -p"$mysql_password" "$mysql_db" -se "SELECT user_group from users where login='$user'" 2>/dev/null | tail -n +1)

        # Si le group n'existepas, on le crée
        if ! grep -q "$group" /etc/group; then
            groupadd "$group"
        fi

        useradd -s /sbin/nologin -M "$user" -g "$group" 2>/dev/null

        # Changa l'UID et le GID du login dans la table
        UID=$(id -u $user)
        GID=$(id -g $user)
        mysql -u"$mysql_user" -p"$mysql_password" "$mysql_db" -se "UPDATE users SET uid='$UID', gid='$GID' WHERE login='$user'" 2>/dev/null

        pass=$(mysql -u"$mysql_user" -p"$mysql_password" "$mysql_db" -se "SELECT password from users where login='$user'" 2>/dev/null | tail -n +1)
        (echo "$pass"; echo "$pass") | smbpasswd -as "$user" 1>/dev/null

        
        mkdir $sambaPath/$user
        chown $user:$group $sambaPath/$user

        # modifier le fichier smb.conf pour ajouter le dossier de l'utilisateur
        echo << EOF >> /etc/samba/smb.conf
        [$user]
        comment = $user
        path = $sambaPath/$user
        browseable = yes
        valid users = $user
        read only = no
        guest ok = no
EOF



        
        echo "L'utilisateur $user a été ajouté"
    fi
done

# Obtenir tous les utilisateurs Samba
smb_users=$(pdbedit -L -v | grep "Unix username" | awk '{print $3}')

# Supprimer les utilisateurs qui ne sont pas dans la base de données MySQL
for smb_user in $smb_users; do
    if ! echo "$mysql_query" | grep -q "$smb_user"; then
        pdbedit -x -u "$smb_user" 2>/dev/null
        userdel "$smb_user" 
        rm -rf $sambaPath/$smb_user
        echo "L'utilisateur $smb_user a été supprimé"
    fi
done
systemctl restart smb
