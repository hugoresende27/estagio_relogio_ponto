 <template>
 
  <div class=" ">
    <nuxt-link to="/" class=" ">
      Laranuxt Aut
    </nuxt-link>

    <!-- logo -->
    <nav class=" ">
      <nuxt-link
        class=" "
        :to="{ name: 'auth-login' }"
        >Login</nuxt-link
      >
      <nuxt-link
        class=" "
        :to="{ name: 'auth-register' }"
        >Register</nuxt-link
      >
    </nav>
  </div>
</template>