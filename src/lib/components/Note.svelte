<script>
    import { createEventDispatcher, onMount } from 'svelte';
    const dispatch = createEventDispatcher();
    export let id;
    export let title = "";
    export let body = "";

    let editableTitle = title;
    let editableBody = body;
    let titleDiv;
    let bodyDiv;
    let isTitleFocused = false;
    let isBodyFocused = false;

    // Skapar texten i title och body
    onMount(() => {
        if (titleDiv) titleDiv.innerText = editableTitle;
        if (bodyDiv) bodyDiv.innerText = editableBody;
    });

    // Synkar texten i title och body med de redigerade värdena när fokus bryts
    $: if (!isTitleFocused && title !== editableTitle) {
        editableTitle = title;
        if (titleDiv) titleDiv.innerText = editableTitle;
    }
    $: if (!isBodyFocused && body !== editableBody) {
        editableBody = body;
        if (bodyDiv) bodyDiv.innerText = editableBody;
    }

    function handleTitleInput(e) {
        editableTitle = e.target.innerText;
    }
    function handleBodyInput(e) {
        editableBody = e.target.innerText;
    }
    function handleEdit() {
        dispatch('edit', { id, title: editableTitle, body: editableBody });
    }
</script>

<div class="note">
    <div class="noteContainer">
        <div class="noteContent" spellcheck="true">
            <div
                role="textbox"
                class="title"
                contenteditable="true"
                bind:this={titleDiv}
                on:focus={() => isTitleFocused = true}
                on:blur={() => { isTitleFocused = false; handleEdit(); }}
                on:input={handleTitleInput}
            ></div>
            <div
                role="textbox"
                class="body"
                contenteditable="true"
                bind:this={bodyDiv}
                on:focus={() => isBodyFocused = true}
                on:blur={() => { isBodyFocused = false; handleEdit(); }}
                on:input={handleBodyInput}
            ></div>
        </div>
        <div class="actions">
            <button 
                class="delete-btn" 
                on:click={() => dispatch('delete', { id })}
                aria-label="Delete note"
            >
                <img src="/images/svg/delete.svg" alt="delete" />
            </button>
        </div>
    </div>
</div>
<style lang="scss">
   %note {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden !important;
    white-space: pre-wrap;
    word-wrap: break-word;
}

.noteContainer {
    width: var(--note-width);
    background-color: #202124;
    transition: box-shadow 0.15s ease-in-out;
    position: relative;     
    border-radius: 8px;
    border: 1px solid #5f6368;
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.6);
    
    &:hover {
        box-shadow: 0 2px 8px 0 rgba(0,0,0,0.8);
        border-color: #8e918f;
    }

    .title {
        @extend %note;
        min-height: 38px;
        margin: 12px 16px 0 16px;
        padding-bottom: 12px;
        letter-spacing: 0.00625em;
        font-family: "Roboto", sans-serif;
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.5rem;
        -webkit-line-clamp: 3;
        color: #e8eaed;
    }
    .body {
                    @extend %note;
                    min-height: 38px;
                    margin: 4px 16px 12px 16px;
                    letter-spacing: 0;
                    font-family: sans-serif;
                    font-size: 1.13rem;
                    font-weight: 400;
                    line-height: 1.5rem;
                    -webkit-line-clamp: 10;
                    color: white;
                }

    button {
        opacity: 0;
        position: absolute;
        right: 4px;
        top: 4px;
        padding: 8px;
        background: transparent;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        transition: opacity 0.2s ease-in-out;

        &:hover {
            background-color: rgba(95, 99, 104, 0.3);
        }

        img {
            width: 20px;
            height: 20px;
            filter: invert(100%);
        }
    }

    &:hover button {
        opacity: 1;
    }
}
</style>
