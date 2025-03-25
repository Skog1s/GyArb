<script>
    import { createEventDispatcher } from 'svelte';
    const dispatch = createEventDispatcher();
    export let title = "";
    export let body = "";
</script>

<div class="note">
    <div class="noteContainer">
        <div class="noteContent" contenteditable="true" spellcheck="true">
            <div role="textbox" class="title">{title}</div>
            <div role="textbox" class="body">{body}</div>
        </div>
        <div class="actions">
            <button 
                class="delete-btn" 
                on:click={() => dispatch('delete')}
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
                transition: all 0.3s;
                position: relative;     
                border-radius: 8px;

                .title {
                    @extend %note;
                    min-height: 38px;
                    margin: 12p 16px 0 16px;
                    letter-spacing: 0.007em;
                    font-family: sans-serif;
                    font-size: 1rem;
                    font-weight: 500;
                    line-height: 1.5rem;
                    -webkit-line-clamp: 3;
                    color: white
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
            }

            .actions {
        opacity: 0;
        padding: 8px;
        display: flex;
        justify-content: flex-end;
        transition: opacity 0.2s ease;
    }

    .noteContainer:hover .actions {
        opacity: 1;
    }

    .delete-btn {
        background: none;
        border: none;
        padding: 8px;
        cursor: pointer;
        border-radius: 50%;
        transition: background-color 0.2s ease;

        &:hover {
            background-color: rgba(95, 99, 104, 0.3);
        }

        img {
            width: 20px;
            height: 20px;
            opacity: 0.7;
        }
    }
        
    
</style>
