<template>
  <div class="d-flex justify-content-between align-items-start">
      <div>
          <h1>Team race</h1>
          <form @submit.prevent="updateStartingTime()">
              <div class="mb-3">
                  <label for="starting-time" class="form-label">Starting time</label>
                  <input type="datetime-local" class="form-control" id="starting-time" aria-describedby="starting-time" v-model="teamRace.startingTime">
              </div>
              <div class="mb-3">
                  <label for="interval" class="form-label">Interval</label>
                  <input type="text" class="form-control" id="interval" aria-describedby="interval" v-model="teamRace.interval">
              </div>
              <button type="submit" class="btn btn-primary">Update starting time</button>
          </form>
      </div>
      <button class="btn btn-secondary" @click="logout">Logout</button>
  </div>
    <hr>
    <h1>Teams</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Order</th>
                <th scope="col">Team name</th>
                <th scope="col">Access code</th>
                <th scope="col">Contact e-mail</th>
                <th scope="col">Average Pace</th>
                <th scope="col">Starting Time</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
            <tbody>
                <tr v-for="(team, index) in teams" :key="index">
                    <th scope="row"><button class="btn btn-secondary btn-sm m-1" v-if="index !== 0" @click="up(index)">Up</button><button class="btn btn-secondary btn-sm" v-if="teams.length !== index + 1" @click="down(index)">Down</button></th>
                    <th scope="row"><input type="text" :ref="index+'name'" :value="team.name"></th>
                    <th scope="row"><input type="text" :ref="index+'accessCode'" :value="team.accessCode"></th>
                    <th scope="row"><input type="text" :ref="index+'contactEmail'" :value="team.contactEmail"></th>
                    <th scope="row">{{ team.averagePace }}</th>
                    <th scope="row">{{ team.startingTime }}</th>
                    <th scope="row"><button class="btn btn-warning btn-sm m-1" @click="edit(index, team.id)">Save</button><button class="btn btn-danger btn-sm m-1" @click="deleteRow(team.id)">Delete</button></th>
                </tr>
            </tbody>
    </table>
    <button class="btn btn-secondary m-1">Reorder by average pace</button>
    <button class="btn btn-secondary">Reorder by average pace</button>
</template>

<script>
import axios from "axios";

export default {
    data () {
        return {
            teams: [],
            teamRace: {
                startingTime: null,
                interval: 5
            }
        }
    },
    mounted () {
        axios.defaults.headers['authorization'] = 'Bearer ' + localStorage.getItem('token')
        this.axios.get('/teams').then((response) => {
            this.teams = response.data.data
            this.teamRace.startingTime = this.teams[0].startingTime
        }).catch(() => {
            this.$router.push('login')
        })
    },
    methods: {
        submit() {
            console.log('yesys')
        },
        logout() {
            localStorage.removeItem('token')
            this.$router.push('login')
        },
        updateStartingTime() {
            this.teams = this.teams.map((team, index) => {
                if (index === 0) {
                    team.startingTime = this.teamRace.startingTime
                    return team
                }
                team.startingTime = new Date(new Date(this.teams[index-1].startingTime).getTime() + parseInt(this.teamRace.interval) * 60000) // Created by using internet
                team.startingTime = `${team.startingTime.getFullYear()}-${team.startingTime.getMonth()+1}-${team.startingTime.getDate()} ${team.startingTime.getHours()}:${team.startingTime.getMinutes() < 10 ? team.startingTime.getMinutes() + '0' : team.startingTime.getMinutes()}`
                return team
            })
        },
        down(index) {
            let temp = this.teams[index];
            this.teams[index] = this.teams[index+1];
            this.teams[index+1] = temp;
        },
        up(index) {
            let temp = this.teams[index];
            this.teams[index] = this.teams[index-1];
            this.teams[index-1] = temp;
        },
        edit(index, id) {
            let name = this.$refs[index+'name'][0].value
            let accessCode = this.$refs[index+'name'][0].value
            let contactEmail = this.$refs[index+'name'][0].value

            this.axios.put('/teams/' + id, {name: name, accessCode: accessCode, contactEmail: contactEmail}).then(() => {
                alert('Team successfully edited')
            });
        },
        deleteRow(id) {
            if(!confirm('Are you sure?')) { return 0}
            this.axios.delete('/teams/' + id).then(() => {
                this.axios.get('/teams').then((response) => {
                    this.teams = response.data.data
                    this.teamRace.startingTime = this.teams[0].startingTime
                }).catch(() => {
                    this.$router.push('login')
                })
            });
        }
    }
}
</script>
