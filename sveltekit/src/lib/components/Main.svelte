<script>

var isCheckbox = false;

</script>

<!--Input-->

<div class="mainContainer">
    <!--Input container-->
<div class="placeholder">
    <input class="input" placeholder="Take a note..." type="text"> <!--Skriv funktion för klicket-->
    <div class="checkIcon"></div> <!--Funktion för att aktivera-->
    <div class="paintIcon"></div> <!--Funktion för att aktivera-->
</div>

<!--UI för ny note-->
<div class="noteMain" hidden>
    <div class="noteContainer">
        <div class="noteTitle ph">Title</div>
        <div class="noteTitle" contenteditable="true" spellcheck="true"></div>
    </div>
</div>

</div>

<!--Note Area-->




<style lang="scss">

.mainContainer {
    margin: 24px auto 16px;
    max-width: 600px;
    width: 100%;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 60%), 0 2px 6px 2px rgb(0 0 0 / 30%);
    position: relative;
}

.placeholder {
    .input {
        padding: 21px 6px 11px 16px;
        font-family: sans-serif;
        height: 46px;
        width: 100%;
        background-color: #202124;
        border: 1px solid #5f6368;
        border-radius: 8px;
        color: white;

        &:focus-visible {
            outline-width: 0;
        }

        &::placeholder {
            letter-spacing: 0.0063em;
            font-family: sans-serif;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.5rem;
            color: rgba(255, 255, 255, 0.702);
        }
    }
}

.noteMain {
    border: 1px solid #5f6368;
    border-radius: 8px;
    background-color: #202124;

    .noteContainer {
        background-position-x: right;
        background-position-y: bottom;
        background-size: cover;

        .noteTitle {
            padding: 10px 15px;
            letter-spacing: 0.0063em;
            font-family: sans-serif;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.5rem;
            white-space: pre-wrap;
            word-wrap: break-word;

            &.ph{
                color: rgba(255, 255, 255, 0.6);
                position: absolute;
                width: 100%;
                pointer-events: none;
                padding-left: 11px;
            }

            &:focus-visible{
                outline: 0;
            }
        }
    }
}

</style>