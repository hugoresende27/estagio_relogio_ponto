<template>
 <div class="container dark">
       <div class="">Register</div>

        <form action="" @submit.prevent="submitForm">
            <div class="">
        <input type="email" v-model="form.email" class="" placeholder-gray-500 placeholder="Enter your email" /><br>
         <p class=" " v-if="errors.email">
          {{ errors.email.join(" ") }}
        </p>
          <input type="text" v-model="form.username" class="" placeholder-gray-500 placeholder="Enter your username" /><br>
          <p class=" " v-if="errors.username">
          {{ errors.username.join(" ") }}
        </p>
          <input type="password" v-model="form.password" class="" placeholder-gray-500 placeholder="Password" /><br>
          <p class=" " v-if="errors.password">
          {{ errors.password.join(" ") }}
        </p>
          <input type="password" v-model="form.password_confirmation" class="" placeholder-gray-500 placeholder="Confirm your password" /><br>
          <p class="" v-if="errors.password_confirmation">
          {{ errors.password_confirmation.join(" ") }}
        </p>
          <button class="  bg-green-300 text-white font-serif">SEND</button>
          </div>
        </form>
          <div class="">Already have an account? <nuxt-link class="" :to="{name:'auth-login'}">Login</nuxt-link>
          </div>
      </div>

</template>

<script>
export default {
    data(){
        return{
            errors:{

            },
            form: {

        username: "",
        email: "",
        password: "",
        password_confirmation: ""
      }
        }

    },
    methods:{
       async submitForm(){
           this.errors='';
           try {
               const res= await this.$axios.$post("api/auth/register", this.form);
            //    console.log(res);
            console.log(res);
           } catch (error) {
               if(error.response.status===422){
                   this.errors = error?.response?.data?.errors;
               console.log(this.errors);

               }

           }


        }
    }

}
</script>
