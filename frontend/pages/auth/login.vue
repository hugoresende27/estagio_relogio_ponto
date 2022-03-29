<template>
  <div class="container mx-auto sm:w-4/5 xl:w-1/4 border p-10 rounded-xl">
       <div class="text-center -mt-4">Login</div>

      <div class="md:w-1/2 ">
             <form @submit.prevent="submitForm" action="" class="space-y-3">
        <input type="text" v-model="form.email"  class="px-6  border rounded-md" placeholder-gray-500 placeholder="Enter your email" /><br>

        <p class=" text-red-500 text-xs text-center" v-if="errors.email">
          {{ errors.email.join(" ") }}
        </p>
          <input type="password" v-model="form.password"  class="px-6  border rounded-md" placeholder-gray-500 placeholder="Enter your password" /><br>
          <p class=" text-red-500 text-xs text-center" v-if="errors.password">
          {{ errors.password.join(" ") }}
        </p>

          <button class="px-6 py-1 bg-yellow-300 text-white font-serif">SEND</button>
             </form>
          <div class="text-xs "> Not Registered? <nuxt-link class="text-blue-600" :to="{name:'auth-register'}">Register</nuxt-link></div>


  </div>
  </div>
</template>

<script>
// import swal from 'sweetalert2'
 export default {
   data(){
         return{
             errors:{

            },
            form: {


       email: "",
        password: "",
               }
        }

    },
    methods:{
       async submitForm() {
      this.errors = {};
      try {
         await this.$axios.$post("api/auth/login", this.form);
        };
        // this.$router.push({ name: "auth-login" });

      } catch (error) {
        if (error.response.status === 422) {
          this.errors = error?.response?.data?.errors;
          return;
        }
        // if (error.response.status === 401) {

      }
    }
  }
};
</script>