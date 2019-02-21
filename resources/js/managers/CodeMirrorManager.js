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
        let cOptions = this.getOptions(options);
        cOptions.mode = "css";

        this.twigInputs.push(
            CodeMirror.fromTextArea(el, cOptions)
        );
    }

    initJsInput(el, options = {}) {
        let cOptions = this.getOptions(options);
        cOptions.mode = "js";

        this.twigInputs.push(
            CodeMirror.fromTextArea(el, cOptions)
        );
    }

    initTwigInput(el, options = {}) {
        let cOptions = this.getOptions(options);
        cOptions.mode = "twig";

        this.twigInputs.push(
            CodeMirror.fromTextArea(el, cOptions)
        );
    }

    getOptions(options) {
        return {
            autoCloseBrackets: (options.autoCloseBrackets !== undefined) ? options.autoCloseBrackets : false,
            readOnly: (options.readOnly !== undefined) ? options.readOnly : false,
            // viewportMargin: (options.readOnly !== undefined) ? options.viewportMargin : 10,
        };
    }
}

export default new CodeMirrorManager();