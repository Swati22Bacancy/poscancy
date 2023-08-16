<script setup>
const username = ref('')
const email = ref('')
</script>

<template>
  <div>
    <VRow>
      <VCol
        cols="12"
        md="12"
      >
        <VCard title="User Profile">
          <VCardText>
            <VForm @submit.prevent="updateprofile">
              <VRow>
                <VCol cols="12">
                  <VRow no-gutters>
                    <!-- Name -->
                    <VCol
                      cols="12"
                      md="3"
                    >
                      <label for="username">Name</label>
                    </VCol>

                    <VCol
                      cols="12"
                      md="9"
                    >
                      <VTextField
                        id="username"
                        v-model="username"
                        placeholder=""
                        persistent-placeholder
                      />
                    </VCol>
                  </VRow>
                </VCol>

                <VCol cols="12">
                  <VRow no-gutters>
                    <!-- Email -->
                    <VCol
                      cols="12"
                      md="3"
                    >
                      <label for="email">Email</label>
                    </VCol>

                    <VCol
                      cols="12"
                      md="9"
                    >
                      <VTextField
                        id="email"
                        v-model="email"
                        placeholder=""
                        persistent-placeholder
                      />
                    </VCol>
                  </VRow>
                </VCol>

                <VCol
                  offset-md="3"
                  cols="12"
                  md="9"
                  class="d-flex gap-4"
                >
                  <VBtn type="submit">
                    Submit
                  </VBtn>
                  
                </VCol>
              </VRow>
            </VForm>
          </VCardText>
        </VCard>
      </VCol>
      
    </VRow>
  </div>
</template>

<script>
  
  export default {
    mounted(){
        this.showProfile()
    },
    methods: {
      async showProfile(){
          await this.$http.get(`/user-detail/1`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            }).then(response=>{
              username.value = response.data.name
              email.value = response.data.email
          }).catch(error=>{
              console.log(error)
          })
      },

      updateprofile() {
        const updatedata = {
          name: username.value,
          email: email.value,
        };
       
        this.$http.post(`/update-profile/1`, updatedata, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            })
          .then(response => {
            this.$router.push('/profile');
          })
          .catch(error => {
            
          });
      },
    },
  };
  </script>
