<script>
import Note from "./Note.svelte";

function createNote() {


}

</script>

<main>

<section class="noteArea">

    <div id="noteTaker">
        <input contenteditable="true" role="textbox" placeholder="Gör en anteckning …" id="textArea">
       <button id="checkList">&#9745;</button>
    </div>


</section>

</main>


<style lang="scss">
    main{
        width: 100%;
        height: 100vh;
        background-color: #44474b;
    }
.noteArea {
 
    #noteTaker {
        display: inline;
       

        #textArea {
            width: 100%;
            max-width: fit-content;
            max-block-size: 500px;
       }
    }

}

</style>