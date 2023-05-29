<template>
  <main>
      <div v-if="error" class="alert alert-danger" role="alert">
          {{ error }}
      </div>
      <form @submit.prevent="submit">
          <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" aria-describedby="username" v-model="form.username">
          </div>
          <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" aria-describedby="password" v-model="form.password">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </main>
</template>

<script>
export default {
    data () {
        return {
            form: {
                username: null,
                password: null
            },
            error: null
        }
    },
    methods: {
        submit() {
            this.error = null
            this.axios.post('/login', this.form).then((response) => {
                localStorage.setItem('token', response.data.token)
                this.$router.push('/')
            }).catch(()=> {
                this.error = 'Invalid credentials'
            })
        }
    }
}
</script>
