<script>
    import Note from "./Note.svelte";
    import { slide } from 'svelte/transition';
    import { onMount } from "svelte";

    let inputValue = "";
    let titleValue = "";
    let notes = [];
    let isCheckbox = false;
    let isInputFocused = false;

    function addNote() {
        if (inputValue.trim() !== "") {
            const newNote = {
                title: titleValue,
                body: inputValue,
                isCheckbox: isCheckbox
            };
            notes = [...notes, newNote];
            inputValue = ""; 
            titleValue = "";
            isInputFocused = false;
        }
    }

    function handleKeyPress(event) {
        if (event.key === "Enter") {
            addNote();
        }
    }

    function deleteNote(index) {
        notes = notes.filter((_, i) => i !== index);
    }
</script>

<!--Input-->

<div class="mainContainer">
    <div class="input-container" class:expanded={isInputFocused}>
        {#if isInputFocused}
            <input 
                transition:slide
                class="input title-input" 
                placeholder="Title" 
                type="text" 
                bind:value={titleValue}
            >
        {/if}
        <input 
            class="input body-input" 
            placeholder="Take a note..." 
            type="text" 
            bind:value={inputValue}
            on:focus={() => isInputFocused = true}
            on:blur={(e) => {
                if (!inputValue) isInputFocused = false;
            }}
            on:keypress={handleKeyPress}
        >
    </div>
    <div class="noteArea" id="noteArea">
        {#each notes as note}
            <Note title={note.title} 
            body={note.body}
            on:delete={() => deleteNote(index)}
            />
        {/each}
    </div>
</div>





<style lang="scss">

.noteArea {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 16px;
        padding: 16px;
        margin-top: 32px;
    }
    
    @media (max-width: 600px) {
        .noteArea {
            grid-template-columns: 1fr;
        }
    }
.input-container {
        background-color: #202124;
        border: 1px solid #5f6368;
        border-radius: 8px;
        padding: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 1px 2px 0 rgba(0,0,0,0.6);
        
        &.expanded {
            min-height: 108px;
            box-shadow: 0 2px 6px 2px rgba(0,0,0,0.3);
        }
    }

    .input {
        width: 100%;
        background: transparent;
        border: none;
        color: white;
        font-family: sans-serif;
        
        &:focus {
            outline: none;
        }

        &::placeholder {
            color: rgba(255,255,255,0.702);
        }
    }

    .title-input {
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .body-input {
        font-size: 0.875rem;
    }
.mainContainer {
    margin: 24px auto 16px;
    max-width: 600px;
    width: 100%;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 60%), 0 2px 6px 2px rgb(0 0 0 / 30%);
    position: relative;
}

.placeholder {
    .title-input {
        margin-bottom: 8px;
        height: 32px;
        padding: 8px 16px;
    }   
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