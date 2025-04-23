<script>
    import { sidebarOpen } from '../stores/sidebarStore';
    
    function toggleSidebar() {
        sidebarOpen.update(value => !value);
    }
    function changeView() {}
    
    function refresh() {}
    
        //Cancel Search funktion
        let inputField;
        let newFieldValue = '';
    
        const onInput = (event) => {
            inputField.value = '';
        }
            
    
    </script>
    
    <nav class="navWrapper">
        <section class="navBar">
            <div class="col-1">
                <button class="menuBtn" on:click={toggleSidebar}>
                    <img src="/images/svg/menu.svg" alt="menuBtn" />
                </button>
                <aside class="keepLogo">
                    <img src="/images/logo.png" alt="logo" />
                </aside>
                <span class="text">Keep</span>
            </div>
    
            <div class="col-2">
                <div class="searchContainer">
                    <form class="searchBar">
                        <search class="inputContainer">
                            <input class="input" placeholder="Search" type="text" bind:this={inputField}/>
                        </search>
                        <button
                            class="clearBtn"
                            aria-label="Clear Search"
                            on:click={onInput}
                        >
                            <img src="/images/svg/close.svg" alt="X" />
                        </button>
                        <button class="searchBtn">
                            <img src="/images/svg/search.svg" alt="search" />
                        </button>
                    </form>
                </div>
                <div class="btnContainer">
                    <button
                        class="refreshBtn"
                        aria-label="Refresh"
                        on:click={refresh}>&#160;</button
                    >
                    <button class="viewBtn" aria-label="View" on:click={changeView}
                    ></button>
                    <button class="settingsBtn" aria-label="Settings"></button>
                </div>
    
                <div class="col-3">
                    <div class="appMenu"></div>
                    <div class="userContainer">
                        <img
                            src="/images/Default_pfp.jpg"
                            alt="pfp"
                            class="userProfile"
                        />
                    </div>
                </div>
            </div>
        </section>
    </nav>
    
    <style lang="scss">
        //variabler
        %icons {
            height: 48px;
            width: 48px;
            background-size: 24px 24px;
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.54;
            transition: opacity 0.218s linear;
            position: relative;
    
            &:hover {
                opacity: 0.87;
            }
        }
    
        //Scss
        .navWrapper {
            padding: 8px 8px;
            box-shadow: inset 0 -1px 0 0 #5f6368;
    
            .navBar {
                display: flex;
                align-items: center;
                justify-content: space-between;
    
                //Kolumn 1
    
                .col-1 {
                    min-width: 232px;
                    display: flex;
                    align-items: center;
                    height: 48px;
    
                    .menuBtn {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 4px;
    padding: 12px;
    width: 48px;
    height: 48px;
    border: none;
    border-radius: 50%;
    background: transparent;
    transition: background 0.2s, box-shadow 0.2s;
    cursor: pointer;
    box-shadow: none;

    &:hover, &:focus {
        background: rgba(232, 234, 246, 0.08);
        box-shadow: 0 2px 8px 0 rgba(0,0,0,0.12);
        outline: none;
    }

    img {
        width: 24px;
        height: 24px;
        filter: invert(80%);
        transition: filter 0.2s;
    }
}
    
                    .text {
                        color: rgba(255, 255, 255, 0.87);
                        font-family: sans-serif;
                        font-size: 22px;
                        font-weight: bold;
                        vertical-align: middle;
                        top: 0.5px;
                        line-height: 24px;
                        padding-left: 8px;
                        position: relative;
                    }
                }
    
                //Kolumn 2
    
                .col-2 {
                    display: flex;
                    justify-content: flex-end;
                    width: 100%;
                    align-items: center;
    
                    @media (max-width: 405px) {
                        justify-content: start;
                    }
    
                    .searchContainer {
                        padding-left: 10px;
                        padding-right: 30px;
                        width: 100%;
    
                        @media (max-width: 794px) {
                            display: none;
                        }
    
                        .searchBar {
                            background: rgba(241, 243, 244, 0.24);
                            max-width: 722px;
                            border-radius: 8px;
                            border: 1px solid transparent;
                            position: relative;
    
                            .inputContainer {
                                margin-left: 54px;
                                margin-right: 49px;
    
                                .input {
                                    color: white;
                                    background: transparent;
                                    font-size: 16px;
                                    font-family: sans-serif;
                                    height: 46px;
                                    width: 100%;
                                    border: 0;
    
                                    &::placeholder {
                                        color: #e8eaed;
                                        font-weight: 100;
                                    }
                                }
                            }
    
                            .clearBtn {
                                width: 56px;
                                height: 46px;
                                background: none;
                                border: none;
                                position: absolute;
                                top: 0;
                                right: 0;
                            }
    
                            .searchBtn {
                                width: 56px;
                                height: 46px;
                                background: none;
                                border: none;
                                position: absolute;
                                top: 0;
                                right: 0;
                                left: 0;
                            }
                        }
                    }
    
                    .btnContainer {
                        display: flex;
    
                        .refreshBtn {
                            @extend %icons;
                            background-image: url(/images/svg/refresh.svg);
                            background-color: transparent;
                            
                        }
    
                        .viewBtn {
                            @extend %icons;
                            background-image: url(/images/svg/view.svg);
                            background-color: transparent;
                            
    
                        }
    
                        .settingsBtn {
                            @extend %icons;
                            background-image: url(/images/svg/settings.svg);
                            background-color: transparent;
    
                        }
                        @media (max-width: 794px) {
                            display: block;
                        }
                    }
                }
    
                //Kolumn 3
    
                .col-3 {
                    display: flex;
                    align-items: center;
                    height: 48px;
                    padding: 0px 4px;
                    padding-left: 28px;
    
                    @media (max-width: 405px) {
                        display: none;
                    }
    
                    .appMenu {
                        @extend %icons;
                        background-image: url(/images/svg/apps.svg);
                        position: relative;
                        right: 2px;
                    }
    
                    .userContainer {
                        padding: 4px 6px;
                        display: inline-block;
    
                        .userProfile {
                            border-radius: 50%;
                            height: 32px;
                            width: 32px;
                            margin-bottom: 1px;
                        }
                    }
                }
            }
        }
    </style>
    