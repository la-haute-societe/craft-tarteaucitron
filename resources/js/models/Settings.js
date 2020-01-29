import CodeMirrorManager from "../managers/CodeMirrorManager";

// Constantes
const CSS_INPUTS_ID = ["settings-customCss"];

const JS_INPUTS_ID = [
  "settings-googleAnalyticsUniversalMore",
  "settings-facebookPixelMore",
  "settings-reCAPTCHAMore"
];

const TWIG_INPUTS_ID = [
  "settings-tarteaucitronInitCallExample",
  "settings-googleMapsCallExample",
  "settings-reCAPTCHACallExample",
  "settings-googleAdWordsConversionCallExample",
  "settings-linkedinCallExample",
  "settings-twitterFollowButtonCallExample",
  "settings-twitterShareButtonCallExample",
  "settings-vimeoCallExample",
  "settings-youtubeCallExample"
];

export default class Settings {
  constructor() {}

  init() {
    this.setCollapsingElements();
    this.initCodeMirrorInputs();
  }

  initCodeMirrorInputs() {
    CSS_INPUTS_ID.forEach(id => {
      let el = document.getElementById(id);
      if (el) {
        CodeMirrorManager.initCssInput(el, CSS_INPUTS_ID[id]);
      }
    });

    JS_INPUTS_ID.forEach(id => {
      let el = document.getElementById(id);
      if (el) {
        CodeMirrorManager.initJsInput(el, { autoCloseBrackets: true });
      }
    });

    TWIG_INPUTS_ID.forEach(id => {
      let el = document.getElementById(id);
      if (el) {
        CodeMirrorManager.initTwigInput(el, {
          readOnly: true,
          cursorBlinkRate: -1
        });
      }
    });
  }

  setCollapsingElements() {
    // Set height of each collapsing element
    document.addEventListener("DOMContentLoaded", function() {
      Array.prototype.forEach.call(
        document.getElementsByClassName("collapse__content"),
        function(hideable) {
          hideable.style.maxHeight = hideable.scrollHeight + "px";
        }
      );
    });

    document.querySelectorAll(".collapse__enable").forEach(function(el) {
      // Collapse if enabled
      let isEnabled = el.querySelector("input").value;
      let collapser = el.nextSibling.nextSibling;
      if (isEnabled) {
        collapser.checked = isEnabled;
      }

      // Collapse / uncollapse on click
      el.addEventListener("click", function() {
        let isEnabled = el.querySelector("input").value;
        let collapser = el.nextSibling.nextSibling;
        if (collapser.type === "checkbox") {
          collapser.checked = isEnabled;
        } else {
          console.log("Error: collapser template is poorly formated.");
        }
      });
    });
  }
}
