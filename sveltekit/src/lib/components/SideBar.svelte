<script>
    import { sidebarOpen } from '../stores/sidebarStore';
   </script>
   
   <aside class="sideBar {$sidebarOpen ? 'open' : 'closed'}">
       <div class="object">
           <img src="/images/svg/light.svg" alt="light" class="icon">
           <span class="text">Notes</span>
       </div>
       <div class="object disabled">
           <img src="/images/svg/notifs.svg" alt="notifications" class="icon"> 
           <span class="text">Reminders</span>
       </div>
   
       <div class="object">
           <img src="/images/svg/label.svg" alt="label" class="icon">
           <span class="text"></span>
       </div>
   
       <div class="object">
           <img src="/images/svg/edit.svg" alt="edit" class="icon">
           <span class="text">Edit labels</span>
       </div>
       <div class="object">
           <img src="/images/svg/archive.svg" alt="archive" class="icon">
           <span class="text">Archive</span>
       </div>
       <div class="object">
           <img src="/images/svg/delete.svg" alt="delete" class="icon">
           <span class="text">Trash</span>
       </div>
   </aside>
   
   <div class="modalContainer">
       <div class="modal">
           <div class="modalLabel">
               <div class="header">
                   <p>Edit Labels</p>
                   <div class="inputContainer">
                       <div class="plusIcon" ></div> <!--Skriv funktion för toggle-->
                       <input type="text" placeholder="Create New Label"  maxlength="50"> <!--Skriv funktion för skrift-->
                       <div class="checkIcon"></div> <!--Skriv funktion för klick och tillägg-->
                   </div>
                   <div class="error" hidden>Label already exists</div>
                   <div class="labelContainer">
                       <input class="trashIcon">
                       <div class="penIcon"></div>
                   </div>
               </div>
               <div class="footer">
                   <div role="button" type="submit" tabindex="0">Done</div> <!--Skriv funktion för att dölja modulen-->
               </div>
           </div>
       </div>
   </div>
   
   
   
   <style lang="scss">
   
   %icon {
       background-size: 18px 18px;
       height: 24px;
       opacity: 0.54;
       width: 24px;
       background-repeat: no-repeat;
       background-position: center;
   }
   
   .sideBar{
       display: flex;
       flex-direction: column;
       width: 280px;
       transition: width 0.3s ease;
   
   
       @media(max-width: 599px) {
           &:not(.close) {
               position: fixed;
               z-index: 100;
               box-shadow: 0 16px 10px rgb(0 0 0 / 14%), 0 11px 18px 0 rgb(0 0 0 / 12%), 0 13px 5px -1px rgb(0 0 0 / 20%);
               height: 100vh;
               background-color: #202124;
           }
       }
       
       &.closed {
           width: 50px;
   
           .object {
               &.active {
                   width: 48px;
                   padding-left: 0;
                   margin-left: 12px;
                   border-radius: 50%;
   
                   img {
                       opacity: 0.87;
                   }
               }
   
               &:hover:not(.active) {
                   width: 48px;
                   height: 48px;
                   padding-left: 0;
                   margin-left: 12px;
                   border-radius: 50%;
               }
           }
   
       }
   
       .object {
           box-sizing: border-box;
           border: 1px solid transparent;
           border-radius: 0 25px 25px 0;
           color: white;
           display: flex;
           align-items: center;
           letter-spacing: 0.018em;
           font-family: sans-serif;
           font-size: 0.9rem;
           font-weight: 450;
           line-height: 1.25rem;
           width: 100%;
           height: 48px;
           overflow: hidden;
           cursor: pointer;
           padding-left: 12px;
           transition: all 0.08s;
   
           .icon{
               opacity: 0.54;
               padding: 0 12px;
           }
   
           .text{
               padding-left: 2px;
               margin-left: 20px;
               overflow: hidden !important;
               text-overflow: ellipsis;
               white-space: nowrap;
           }
           
           &.active {
               background-color: #41331c;
           }
   
           &:hover:not(.active) {
               background-color: #28292c;
           }
               
       }
   }
   
   
   .modalContainer {
       position: fixed;
       display: none;
       z-index: 1;
       left: 0;
       top: 0;
       width: 100%;
       height: 100%;
       background-color: black;
       overflow: hidden;
   
       .modal{
           position: absolute;
           transform: translate(-50%, -50%);
           left: 50%;
           top: 40%;
           transition: all 4.0s;
           max-width: 300px;
           width: 100%;
       }
   }
   
   .modalLabel {
       background-color: #313235;
       border: 1px;
       box-shadow: 0 1px 3px 0 rgb(0 0 0 / 60%), 0 4px 8px 3px rgb(0 0 0 / 30%);
   
       input {
           flex: 1 1 auto;
           font-size: 14px;
           font-weight: 500;
           margin: 0 15px;
           background-color: transparent;
           border: none;
           border-bottom: 1px solid transparent;
           box-shadow: none;
           color: white;
           font-family: sans-serif;
           height: 25px;
           outline: none;
           padding: 0;
       }
   
       input:focus {
           border-bottom: 1px solid #5f6368;
       }
   
       input::placeholder {
           color: white;
           opacity: 0.5;
       }
   
      .header {
       padding: 15px;
   
       .error {
           color: #f6aea9;
           cursor: default;
           font-size: smaller;
           font-style: italic;
           padding: 10px;
           font-family: sans-serif;
           font-size: 12.5px;
       }
   
       p {
           color: white;
           letter-spacing: 0.0063em;
           font-family: sans-serif;
           font-size: 1rem;
           font-weight: 500;
           line-height: 1.5rem;
           height: 25px;
           margin: 0;
       }
   
       .inputContainer {
           display: flex;
           align-items: center;
           height: 45px;
   
           .plusIcon {
               background-image: url(/images/svg/plus.svg);
               @extend %icon;
           }
   
           .checkIcon {
               background-image: url(/images/svg/check.svg);
               @extend %icon;
           }
       }
   
       .labelContainer {
           @extend .inputContainer;
   
           .labelIcon {
               background-image: url(/images/svg/importantLabel.svg);
               @extend %icon;
           }
   
           .penIcon {
               background-image: url(/images/svg/edit.svg);
               @extend %icon;
           }
   
           .trashIcon {
               background-image: url(/images/svg/delete.svg);
               @extend %icon;
           }
   
           .input:focus+.penIcon {
               background-image: url(/images/svg/check.svg);
           }
   
           .labelIcon:hover {
               background-image: url(/images/svg/delete.svg);
           }
       }
   
      }
   
      .footer {
       border-top: 1px solid #5f6368;
       padding: 15px 10px;
       text-align: right;
   
       div {
           box-sizing: border-box;
           color: lightgrey;
           overflow: hidden;
           text-overflow: ellipsis;
           white-space: nowrap;
           letter-spacing: 0.02em;
           font-family: sans-serif;
           font-size: 0.9rem;
           font-weight: 500;
           line-height: 1.25rem;
           height: 36px;
           padding: 8px 24px;
           border-radius: 4px;
           display: inline-block;
       }
   
       div:hover {
           background-color: rgba(154, 160, 166, 0.039);
           cursor: pointer;
       }
      }
   
   }
   
   .disabled {
       cursor: not-allowed;
       opacity: 0.25;
   }
   
   </style>