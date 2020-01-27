import CodeMirrorManager from "../managers/CodeMirrorManager";

// Constantes
const CSS_INPUTS_ID = {
    'settings-customCss': {}
};

const JS_INPUTS_ID = {
    'settings-googleAnalyticsUniversalMore': {'autoCloseBrackets': true},
    'settings-facebookPixelMore': {'autoCloseBrackets': true},
    'settings-reCAPTCHAMore': {'autoCloseBrackets': true},
};

const TWIG_INPUTS_ID = {
    'settings-tarteaucitronInitCallExample': {'readOnly' : true, 'cursorBlinkRate': -1},
    'settings-googleMapsCallExample': {'readOnly' : true, 'cursorBlinkRate': -1},
    'settings-reCAPTCHACallExample': {'readOnly' : true},
    'settings-googleAdwordsConversionCallExample': {'readOnly' : true, 'cursorBlinkRate': -1},
    'settings-linkedinCallExample': {'readOnly' : true, 'cursorBlinkRate': -1},
    'settings-twitterCallExample': {'readOnly' : true, 'cursorBlinkRate': -1},
    'settings-vimeoCallExample': {'readOnly' : true, 'cursorBlinkRate': -1},
    'settings-youtubeCallExample': {'readOnly' : true, 'cursorBlinkRate': -1},
};


export default class Settings {
    constructor() {

    }

    init() {
        this.setCollapsingElements();
        this.initCodeMirrorInputs();
    }

    initCodeMirrorInputs() {
        for (let id in CSS_INPUTS_ID) {
            let el = document.getElementById(id);
            if (el) {
                CodeMirrorManager.initCssInput(el, CSS_INPUTS_ID[id]);
            }
        }

        for (let id in JS_INPUTS_ID) {
            let el = document.getElementById(id);
            if (el) {
                CodeMirrorManager.initJsInput(el, JS_INPUTS_ID[id]);
            }
        }

        for (let id in TWIG_INPUTS_ID) {
            let el = document.getElementById(id);
            if (el) {
                CodeMirrorManager.initTwigInput(el, TWIG_INPUTS_ID[id]);
            }
        }
    }

    setCollapsingElements() {
        // Set height of each collapsing element
        document.addEventListener("DOMContentLoaded",function() {
            Array.prototype.forEach.call(
                document.getElementsByClassName("collapse__content"), function (hideable) {
                    hideable.style.maxHeight = hideable.scrollHeight + "px";
                }
            );
        });

        document.querySelectorAll(".collapse__enable").forEach(function (el) {

            // Collapse if enabled
            let isEnabled = el.querySelector('input').value;
            let collapser = el.nextSibling.nextSibling;
            if (isEnabled) {
                collapser.checked = isEnabled;
            }

            // Collapse / uncollapse on click
            el.addEventListener('click', function (e) {
                let isEnabled = el.querySelector('input').value;
                let collapser = el.nextSibling.nextSibling;
                if (collapser.type === "checkbox") {
                    collapser.checked = isEnabled;
                } else {
                    console.log('Error: collapser template is poorly formated.')
                }
            })
        })
    }
}
