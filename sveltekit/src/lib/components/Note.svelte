<script>

</script>


<!--UI för ny note-->
<div class="mainContainer">
    <div class="note">
        <div class="noteContainer">
            <div class="noteContent" contenteditable="true" spellcheck="true">
                <div role="textbox" class="title">{note}</div>
                <div role="textbox" class="body"></div>
            </div>
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

    .mainContainer {
        margin-top: 45px;
        margin-bottom: 45px;

        .noteContainer {
            width: var(--note-width);
            transition: all 0.3s;
            position: relative;

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
            }
        }
    }
 
</style>