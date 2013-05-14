function basename (path, suffix) {
  // *     example 1: basename('/www/site/home.htm', '.htm');
  // *     returns 1: 'home'
  // *     example 2: basename('ecra.php?p=1');
  // *     returns 2: 'ecra.php?p=1'
  var b = path.replace(/^.*[\/\\]/g, '');

  if (typeof(suffix) == 'string' && b.substr(b.length - suffix.length) == suffix) {
    b = b.substr(0, b.length - suffix.length);
  }

  return b;
}

function enleverExtention (path, suffix) {

  if (typeof(suffix) == 'string' && b.substr(b.length - suffix.length) == suffix) {
    b = b.substr(0, b.length - suffix.length);
  }

  return b;
}
