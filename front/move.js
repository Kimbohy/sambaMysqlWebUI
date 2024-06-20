window.onload =() => {
    if (! window.location.href.includes('page')){
        window.location.href='page.html';
    }else {
        users();
        log();
    }
}