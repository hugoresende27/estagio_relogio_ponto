<template>
    <div class="container">
        <!-- login form -->
        
            <div class="col-6 offset-3">
                <form action="#" @submit.prevent="handleLogin">
                    <h3>Sign in</h3>
                    <div class="form-row">
                        <input type="email" name="email" class="form-control" v-model="formData.email" placeholder="Email Address">
                    </div>
                    <div class="form-row">
                        <input type="password" name="password" class="form-control" v-model="formData.password" placeholder="Password">
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                </form>
            </div>
        
      
      
    </div>
</template>

<script>
    export default {
        data() {
            return {
                employees: [],
                formData: {
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            handleLogin() {
                // send axios request to the login route
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/login', this.formData).then(response => {
                        this.getEmployees();
                    });
                });
            },
            getEmployees() {
                axios.get('/api/employees').then(response => {
                    console.log(response);
                    this.employees = response.data;
                });
            }
        }
    }
</script>

<style>
    .form-row {
        margin-bottom: 8px;
    }
</style>