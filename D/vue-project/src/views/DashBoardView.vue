<template>
    <main>
        <h1>👋 Hi {{ runner }}!</h1>
        <p>Have a good running!</p>
        <h3>Current runner</h3>
        <div class="current-runner-container">
            <div>
                <img src="@/assets/vectors/person.svg">
                <h3>The team has not yet started</h3>
            </div>
            <div>
                <img src="@/assets/vectors/geo-alt.svg">
                <div>
                    <div>
                        <div>-</div>
                        <div>-</div>
                    </div>
                    <div>|-km</div>
                </div>
            </div>
            <div>
                <img src="@/assets/vectors/clock.svg">
                <div>
                </div>
            </div>
        </div>
        <h3>Your next 6.25 km run🏃‍♂️</h3>
        <p style="color: #5F94FF;">5 days & 01:12:31 UNTIL HANDOVER</p>
        <div class="next-run-details-container">
            <div class="next-run-details-box-container">
                <h3>Balatonszárszó</h3>
                <div class="next-run-details-box">
                    <div class="current-container">
                        <img src="../assets/vectors/person-blue-theme.svg">
                        Veronika Szabados
                    </div>
                    <h1>16:18</h1>
                </div>
                <div class="handover-button">
                    <img src="../assets/vectors/check2-circle.svg">
                    <span>Handover now</span>
                </div>
            </div>
            <div class="next-run-details-box-container">
                <h3>Balatonszárszó</h3>
                <div class="next-run-details-box reverse-row">
                    <div class="current-container">
                        <img src="../assets/vectors/person-blue-theme.svg">
                        Veronika Szabados
                    </div>
                    <h1>16:18</h1>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    data () {
        return {
            runner: localStorage.getItem('runner')
        }
    },
    mounted () {

        console.log(localStorage.getItem('runner'))
    }
}
</script>

<style scoped>
main {
    margin-left: auto;
    margin-right: auto;
    width: 90%;
}

h1 {
    margin-bottom: 10px;
}

h3 {
    margin-top: 8px;
    margin-bottom: 5px;
}

.current-runner-container {
    border-radius: 20px;
    color: white;
    background: linear-gradient(to right, #EC0A8C, #7549F6);
    display: flex;
    padding: 20px;
    flex-direction: column;
    gap: 10px;
}

.current-runner-container > div {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin: 0px;
    gap: 5px;
}

.current-runner-container > div > img {
    width: 30px;
    height: 30px;
}

.current-runner-container > div > h3 {
    margin: 0;
}

.current-runner-container > div > div {
    display: flex;
    align-items: center;
    gap: 100px;
}

.current-runner-container > div > div > div {
    display: flex;
    flex-direction: column;
}

.next-run-details-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
    border-radius: 20px;
}

.next-run-details-box-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
    border-radius: 20px;
    background: #F2F4F5;
    padding: 10px;
}

.next-run-details-box-container > h3 {
    margin: 0;
}

.next-run-details-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    column-gap: 40px;
}

.next-run-details-box > h1 {
    margin: 0;
}

.current-container {
    color: #5F94FF;
    border: 1px solid #5F94FF;
    display: flex;
    padding: 4px 10px 4px 10px;
    border-radius: 20px;
}

.handover-button {
    background-color: #2A73FF;
    color: white;
    display: flex;
    column-gap: 10px !important;
    width: 100%;
    align-items: center;
    justify-content: center;
    padding-top: 10px;
    padding-bottom: 10px;
    border-radius: 30px;
}

.handover-button > img {
    width: 25px;
    height: 25px;
}

.reverse-row {
    flex-direction: row-reverse;
}
</style>
