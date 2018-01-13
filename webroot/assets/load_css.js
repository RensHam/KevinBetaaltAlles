function downloadCss() {
    preloadFile("https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css", "sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy");
}

function preloadFile(filename, integrity) {

    var fileref = document.createElement("link");
    fileref.setAttribute("rel", "stylesheet");
    fileref.setAttribute("type", "text/css");
    fileref.setAttribute("href", filename);
    fileref.setAttribute("integrity", integrity);
    fileref.setAttribute("crossorigin", "anonymous");
    document.getElementsByTagName("head")[0].appendChild(fileref);
}

