<template>
    <header>
        <h4>UB 2023 - {{ name }}</h4>
    </header>
    <RouterView />
</template>

<script>
export default {
    data () {
        return {
            name: localStorage.getItem('team_name')
        }
    }
}
</script>

<style scoped>
header {
    height: 40px;
    background-color: #0057FF;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}
</style>
