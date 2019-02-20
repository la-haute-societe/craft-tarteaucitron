import CodeMirrorManager from "./CodeMirrorManager";

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
}