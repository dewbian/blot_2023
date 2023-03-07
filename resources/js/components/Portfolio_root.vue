<template>
    <div class="container full"  style="border:1px solid green;"  >
        <div class="row justify-content-center"> 
            <ul>
                <li v-for="port in ports" :key="port.id" v-on:click= "getDetail(port.id)" style="padding-bottom: 10px;"><strong>{{ port.po_subject }}</strong><br>
                        <div v-for="file in port.portfoilos">
					           <img v-bind:src="file.po_file_url"  class="product-image"/>
				        </div>                         
                </li>
            </ul>                
        </div>
    </div>

</template>

<script>

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
            getDetail(id){
                alert("detail로로로"+id);
            }
        },    
    }    
</script>
<style>
  .product-image  {
    margin-top: 10px;
    width: 50%; 
  }
</style>