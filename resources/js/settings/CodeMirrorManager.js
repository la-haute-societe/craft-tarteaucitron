// CodeMirror
import CodeMirror from "codemirror";
import 'codemirror/mode/css/css.js';
import 'codemirror/mode/javascript/javascript.js';
import 'codemirror/addon/edit/closebrackets.js';

class CodeMirrorManager {
    constructor() {
        this.cssInputs = [];
        this.jsInputs = [];
    }

    initCssInput(el) {
        this.cssInputs.push(
            CodeMirror.fromTextArea(el, {
                mode: "css",
                autoCloseBrackets: true
            })
        );
    }

    initJsInput(el) {
        this.jsInputs.push(
            CodeMirror.fromTextArea(el, {
                mode: "javascript",
                autoCloseBrackets: true
            })
        );
    }
}

export default new CodeMirrorManager();