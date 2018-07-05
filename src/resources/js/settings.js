(function() {
  var cssInput = document.getElementById('settings-customCss');
  var editor = CodeMirror.fromTextArea(cssInput, {
    mode: "css",
    autoCloseBrackets: true,
    showHint: true,
  });
})();