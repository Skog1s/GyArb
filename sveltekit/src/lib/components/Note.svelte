<script>
export function CreateNote() {
var DOMHeadingOne = document.createElement("input");
DOMHeadingOne.setAttribute("type", "text");
DOMHeadingOne.classList.add("e-h1");
document.getElementById("editor").appendChild(DOMHeadingOne);
}

</script>

<body>
<textarea id="note" contenteditable="true">
    <b>…</b>

</textarea>


</body>

<style lang="scss">
    #note {
        position: relative;
        
    }

</style>