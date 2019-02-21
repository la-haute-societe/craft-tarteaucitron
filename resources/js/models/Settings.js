import CodeMirrorManager from "../managers/CodeMirrorManager";

// Constantes
const CSS_INPUTS_ID = [
    'settings-customCss'
];

const JS_INPUTS_ID = [
    'settings-googleAnalyticsUniversalMore'
];


export default class Settings {
    constructor() {

    }

    init() {
        this.setCollapsingElements();
        this.initCodeMirrorInputs();
    }

    initCodeMirrorInputs() {
        for (let id of CSS_INPUTS_ID) {
            let el = document.getElementById(id);
            if (el) {
                CodeMirrorManager.initCssInput(el);
            }
        }

        for (let id of JS_INPUTS_ID) {
            let el = document.getElementById(id);
            if (el) {
                CodeMirrorManager.initJsInput(el);
            }
        }
    }

    setCollapsingElements() {
        // Set height of each ecollapsing element
        Array.prototype.forEach.call(
            document.getElementsByClassName("collapse__content"), function (hideable) {
                hideable.style.maxHeight = hideable.scrollHeight + "px";
            }
        );

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