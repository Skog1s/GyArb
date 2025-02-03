<script>
import Note from "./Note.svelte";

function openNoteModal() {
    document.getElementById("titleArea").style.visibility="visible";
}

function Create() {
    
}

</script>

<main>

<section class="noteArea">

    <div id="noteTaker">
        <input contenteditable="true" role="textbox" placeholder="Title" id="titleArea">
        <input contenteditable="true" role="textbox" placeholder="Gör en anteckning …" id="textArea" on:contextmenu={openNoteModal}>
       <button id="checkList" on:click={Create}>&#9745;</button>
    </div>


</section>

</main>


<style lang="scss">
    main{
        width: 100%;
        height: 100%;
        background-color: #202124;
    }
.noteArea {
 
    #noteTaker {
        padding: 21px 6px 11px 16px;
        height: 46px;
        width: 100%;
        background-color: #202124;
        border: 1px solid #5f6368;
        border-radius: 8px;       

        #textArea {
            letter-spacing: 0.00625em;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.5rem;

       }

       #titleArea {
        width: 100%;
        max-width: fit-content;
        max-block-size: 500px;
        visibility: hidden;
       }
    }

}

</style>