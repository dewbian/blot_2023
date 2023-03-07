<template> <div>aaaaaaaaaaaaaaaaaaaa</div>
</template>

<script>  
/*
Vue.component("blog-read", {
      template: `
      <div>
        <h1>{{ post.title}}</h1>
        <p>{{ post.description}}</p>
      </div>
      `,
      props: ["post"],
      created() {
        // console.log("blog-read created");
      },
      destroyed() {
        // console.log("blog-read destroyed");
      }
    })

    export default {
        mounted() {
            this.getPortfolio();
        }, 

        data: function () {
            return {
                ports: [],
            }
        },    
        methods:{
            getPortfolio(){                
                //포트폴리오 가져오기
                axios.get('/api/portfolio').then(res => { 
                    console.log(res);
                    //res.data.users;
                    this.ports = res.data;
                }).catch(error => {
                    console.log("에러발생");
                });
            },    
            getDetail(port){

            }
        },    
    }    
    */
</script>
<style>
  .product-image  {
    margin-top: 10px;
    width: 50%; 
  }
</style>