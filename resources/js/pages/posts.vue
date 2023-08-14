<template>
  <VRow>
    <VCol cols="12">
      <VCard title="Posts">
        <VBtn type="button" to="/create-post">
          Create
        </VBtn>
        <VTable>
          <thead>
            <tr>
              <th class="text-uppercase">
                Title
              </th>
              <th>
                Description
              </th>
              <th>
                Action
              </th>
            </tr>
          </thead>

          <tbody>
            <tr
              v-for="post in posts"
              :key="post.id"
            >
              <td>
                {{ post.title }}
              </td>
              <td class="text-center">
                {{ post.body }}
              </td>
              <td>
                <VBtn type="button" :to="{ name: 'editpost', params: { id: post.id } }">
                  Edit
                </VBtn>
                <VBtn type="button" @click="deletePost(post.id)" class="btn btn-danger">
                  Delete
                </VBtn>
              </td>
            </tr>
          </tbody>
        </VTable>
      </VCard>
    </VCol>
  </VRow>
</template>

<script>
export default {
    name:"posts",
    data(){
        return {
            posts:[]
        }
    },
    mounted(){
        this.getPosts()
    },
    methods:{
         async getPosts(){
            await this.$http.get('/show-posts', {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            }).then(response=>{
              console.log(response.data);
                this.posts = response.data
            }).catch(error=>{
                console.log(error)
                this.posts = []
            })
        },
        deletePost(id){
            if(confirm("Are you sure to delete this post ?")){
              this.$http.delete(`/delete-post/${id}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            }).then(response=>{
                    this.getPosts()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>
