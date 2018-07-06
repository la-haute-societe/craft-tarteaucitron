(function() {
  var customCssInput = document.getElementById('settings-customCss');
  var customCssEditor = CodeMirror.fromTextArea(customCssInput, {
    mode: "css",
    autoCloseBrackets: true
  });

  var googleAnalyticsUniversalMoreInput = document.getElementById('settings-googleAnalyticsUniversalMore');
  var googleAnalyticsUniversalEditor = CodeMirror.fromTextArea(googleAnalyticsUniversalMoreInput, {
    mode: "javascript",
    autoCloseBrackets: true
  });
})();