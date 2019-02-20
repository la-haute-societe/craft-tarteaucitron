// CodeMirror
import CodeMirror from 'codemirror';
import 'codemirror/mode/css/css.js';
import 'codemirror/mode/javascript/javascript.js';
import 'codemirror/addon/edit/closebrackets.js';

// Styles
import Styles from '../scss/settings.scss';

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