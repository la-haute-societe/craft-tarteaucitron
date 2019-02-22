// CodeMirror
import CodeMirror from "codemirror";
import 'codemirror/mode/css/css.js';
import 'codemirror/mode/javascript/javascript.js';
import 'codemirror/mode/twig/twig';
import 'codemirror/addon/edit/closebrackets.js';

class CodeMirrorManager {
    constructor() {
        this.cssInputs = [];
        this.jsInputs = [];
        this.twigInputs = [];
    }

    initCssInput(el, options = {}) {
        options.mode = "css";

        this.cssInputs.push(
            CodeMirror.fromTextArea(el, options)
        );
    }

    initJsInput(el, options = {}) {
        options.mode = "js";

        this.jsInputs.push(
            CodeMirror.fromTextArea(el, options)
        );
    }

    initTwigInput(el, options = {}) {
        options.mode = "twig";

        this.twigInputs.push(
            CodeMirror.fromTextArea(el, options)
        );
    }
}

export default new CodeMirrorManager();