<script>
    import Note from "./Note.svelte";
    import { slide } from "svelte/transition";
    import { onMount } from "svelte";
    import {
        getNotes,
        addNote,
        deleteNote as dbDeleteNote,
        updateNote,
    } from "../db/db.js";

    let inputValue = "";
    let titleValue = "";
    let notes = [];
    let isCheckbox = false;
    let isInputFocused = false;

    // Laddar in notes från databasen on boot
    onMount(async () => {
        notes = await getNotes();
    });

    async function addNoteHandler() {
        if (inputValue.trim() !== "") {
            const newNote = {
                title: titleValue,
                body: inputValue,
               
            };
            const id = await addNote(newNote);
            notes = await getNotes();
            inputValue = "";
            titleValue = "";
            isInputFocused = false;
        }
    }

    function handleKeyPress(event) {
        if (event.key === "Enter") {
            addNoteHandler();
        }
    }

    async function deleteNoteHandler(id) {
        await dbDeleteNote(id);
        notes = await getNotes();
    }

    async function editNoteHandler(event) {
        const { id, title, body } = event.detail;
        await updateNote(id, { title, body });
        // Updaterar note i den lokala array:en utan att uppdatera alltihopa
        notes = notes.map((note) =>
            note.id === id ? { ...note, title, body } : note,
        );
    }
</script>

<div class="mainContainer">
    <div class="input-container" class:expanded={isInputFocused}>
        {#if isInputFocused}
            <input
                transition:slide
                class="input title-input"
                placeholder="Title"
                type="text"
                bind:value={titleValue}
                tabindex="0"
                on:focus={() => (isInputFocused = true)}
            />
        {/if}
        <input
            class="input body-input"
            placeholder="Take a note..."
            type="text"
            bind:value={inputValue}
            on:focus={() => (isInputFocused = true)}
            on:blur={(e) => {
                const related = e.relatedTarget;
                if (
                    !inputValue &&
                    !titleValue &&
                    (!related || !related.classList?.contains("title-input"))
                ) {
                    isInputFocused = false;
                }
            }}
            on:keypress={handleKeyPress}
        />
    </div>
    <div class="noteArea" id="noteArea">
        {#each notes as note (note.id)}
            <Note
                id={note.id}
                title={note.title}
                body={note.body}
                on:delete={() => deleteNoteHandler(note.id)}
                on:edit={editNoteHandler}
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
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.6);
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;

        &.expanded {
            min-height: 108px;
            box-shadow: 0 2px 6px 2px rgba(0, 0, 0, 0.3);
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
            color: rgba(255, 255, 255, 0.702);
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
        max-width: 1200px;
        width: 100%;
        box-shadow:
            0 1px 2px 0 rgb(0 0 0 / 60%),
            0 2px 6px 2px rgb(0 0 0 / 30%);
        position: relative;
        margin-left: auto;
        margin-right: auto;
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

                &.ph {
                    color: rgba(255, 255, 255, 0.6);
                    position: absolute;
                    width: 100%;
                    pointer-events: none;
                    padding-left: 11px;
                }

                &:focus-visible {
                    outline: 0;
                }
            }
        }
    }
</style>
