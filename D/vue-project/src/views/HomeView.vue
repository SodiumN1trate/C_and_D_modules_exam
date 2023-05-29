<template>
  <main>
      <p>Tap to your name</p>
<!--      Runner list -->
      <div class="container">
          <div class="box" :class="{'empty': runner?.empty }" v-for="(runner, index) in team.runners" :key="index" @click="selectRunner(runner.firstName)">{{ runner.firstName }} {{ runner.lastName }}</div>
      </div>
  </main>
</template>

<script>
export default {
    data () {
        return {
            team: []
        }
    },
    created () {
        if (!this.$route.query.accessCode) { alert('There is no team access code') }
        localStorage.setItem('accessCode', this.$route.query.accessCode)

        this.axios.defaults.headers['authorization'] = 'Bearer ' + this.$route.query.accessCode
        this.axios.get('/myTeam').then((response) => {
            this.team = response.data.data
            localStorage.removeItem('team_name')
            localStorage.setItem('team_name', this.team.name)
            for(let i = 14 - this.team.runners.length; i > 0; i--){
                this.team.runners.push({empty: true})
            }
        }).catch(() => {
            alert('There is no such a team')
        })
    },
    methods: {
      selectRunner (name) {
          localStorage.setItem('runner', name)
          this.$router.push('/dashboard')
      }
    }
}
</script>

<style scoped>
main {
    margin-left: auto;
    margin-right: auto;
    width: 90%;
}

.container {
    display: flex;
    margin-left: auto;
    margin-right: auto;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.box {
    background-color: #E80C8F;
    color: white;
    width: 100%;
    text-align: center;
    border-radius: 20px;
    padding: 10px;
}

.empty {
    background-color: #DCD2D8 !important;
    padding: 10px;
}
</style>
