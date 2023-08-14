<script setup>
import logo from '@images/logo.svg?raw';

const form = ref({
  email: '',
  password: '',
  remember: false,
})

const isPasswordVisible = ref(false)
</script>

<template>
  <div class="auth-wrapper d-flex align-center justify-center pa-4">
    <VCard
      class="auth-card pa-4 pt-7"
      max-width="448"
    >
      <VCardItem class="justify-center">
        <template #prepend>
          <div class="d-flex">
            <div
              class="d-flex text-primary"
              v-html="logo"
            />
          </div>
        </template>

        <VCardTitle class="text-2xl font-weight-bold">
          Poscancy
        </VCardTitle>
      </VCardItem>

      <VCardText class="pt-2">
        <p class="mb-0">
          Please sign-in to your account and start the adventure
        </p>
      </VCardText>

      <VCardText>
        <VForm @submit.prevent="submitForm">
          <VRow>
            <!-- email -->
            <VCol cols="12">
              <VTextField
                v-model="email"
                autofocus
                placeholder="johndoe@email.com"
                label="Email"
                type="email"
              />
            </VCol>

            <!-- password -->
            <VCol cols="12">
              <VTextField
                v-model="password"
                label="Password"
                placeholder="············"
                :type="isPasswordVisible ? 'text' : 'password'"
                :append-inner-icon="isPasswordVisible ? 'bx-hide' : 'bx-show'"
                @click:append-inner="isPasswordVisible = !isPasswordVisible"
              />

              <!-- remember me checkbox -->
              <div class="d-flex align-center justify-space-between flex-wrap mt-1 mb-4">
                <VCheckbox
                  v-model="form.remember"
                  label="Remember me"
                />

                <RouterLink
                  class="text-primary ms-2 mb-1"
                  to="javascript:void(0)"
                >
                  Forgot Password?
                </RouterLink>
              </div>

              <!-- login button -->
              <VBtn
                block
                type="submit"
              >
                Login
              </VBtn>
            </VCol>

            
          </VRow>
        </VForm>
      </VCardText>
    </VCard>
  </div>
</template>
<script>
  
  export default {
    data() {
      return {
        email: '',
        password: '',
        message: '',
      };
    },
    methods: {
      submitForm() {
        const credentials = {
          email: this.email,
          password: this.password,
        };
  
        // Make the API request to Laravel using axios
        this.$http.post('/login', credentials)
          .then(response => {
            localStorage.setItem('token', response.data.token);
            this.$router.push('/dashboard');
            this.message = response.data.message;
          })
          .catch(error => {
            if (error.response) {
              this.message = error.response.data.message;
            } else {
              this.message = 'An error occurred';
            }
          });
      },
    },
  };
  </script>
<style lang="scss">
@use "@core-scss/template/pages/page-auth.scss";
</style>
