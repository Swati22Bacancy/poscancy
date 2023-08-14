<script setup>
const title = ref('')
const body = ref('')
</script>

<template>
  <div>
    <VRow>
      <VCol
        cols="12"
        md="12"
      >
        <VCard title="Create Post">
          <VCardText>
            <VForm @submit.prevent="submitPost">
              <VRow>
                <VCol cols="12">
                  <VRow no-gutters>
                    <VCol
                      cols="12"
                      md="3"
                    >
                      <label for="title">Title</label>
                    </VCol>

                    <VCol
                      cols="12"
                      md="9"
                    >
                      <VTextField
                        id="title"
                        v-model="title"
                        placeholder=""
                        persistent-placeholder
                      />
                    </VCol>
                  </VRow>
                </VCol>

                <VCol cols="12">
                  <VRow no-gutters>
                    <VCol
                      cols="12"
                      md="3"
                    >
                      <label for="description">Description</label>
                    </VCol>

                    <VCol
                      cols="12"
                      md="9"
                    >
                      <VTextField
                        id="body"
                        v-model="body"
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
        this.showPost()
    },
    methods: {
      async showPost(){
          await this.$http.get(`/post-detail/${this.$route.params.id}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            }).then(response=>{
              
              title.value = response.data.title
              body.value = response.data.body
          }).catch(error=>{
              console.log(error)
          })
      },

      submitPost() {
        const postdata = {
          title: title.value,
          body: body.value,
        };
  
        // Make the API request to Laravel using axios
        this.$http.post(`/update-post/${this.$route.params.id}`, postdata, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            })
          .then(response => {
            this.$router.push('/posts');
            //this.message = response.data.message;
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
