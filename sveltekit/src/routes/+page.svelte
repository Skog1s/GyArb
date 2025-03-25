<script>
    import Header from "../lib/components/Header.svelte";
    import Main from "../lib/components/Main.svelte";
    import SideBar from "../lib/components/SideBar.svelte";
</script>

<div class="parent">
    <div class="header"><Header></Header></div>
    <div class="navBar"><SideBar></SideBar></div>
    <div class="main"><Main></Main></div>
</div>

<style lang="scss">


    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
        background-color: #202124;
        
    }

    .parent {
        display: grid;
        grid-template-columns: 0.7fr repeat(3, 1fr);
        grid-template-rows: 0.4fr repeat(4, 1fr);
        grid-column-gap: 0px;
        grid-row-gap: 0px;
        height: 100vh;
        width: 100%;
    }

    .header {
        grid-area: 1 / 1 / 2 / 5;
    }
    .navBar {
        grid-area: 2 / 1 / 6 / 2;
    }
    .main {
        grid-area: 2 / 2 / 6 / 5;
    }
</style>
