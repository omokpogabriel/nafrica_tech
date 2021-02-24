<template>
   <div>
        <!--       LIST OF USER COMPANIES-->
       <section class="company-content">
           <div class="company-wrapper" v-for="companies in user_company" :key="companies.id">
               <div class="company-card-header">
                   <h3>Company {{_count}}</h3>
                   <button class="btn-delete" type="button" @click="delete_company(companies.id)"> [delete] </button>
               </div>
               <div class="company-card-wrapper">
                   <div class="company-card">
                       <h3 class="p-label">Name:</h3>
                       <span>{{companies.company_name}}</span>
                   </div>
                   <div class="company-card">
                       <h3 class="p-label">Email:</h3>
                       <span>{{companies.email}}</span>
                   </div>
                   <div class="company-card">
                       <h3 class="p-label">Country:</h3>
                       <span>{{companies.country}}</span>
                   </div>
               </div>
               <div class="card-bottom">
                   <button class="btn btn-update btn-center" @click="show_update_company(companies)">Update</button>
               </div>
           </div>
           <div class="company-wrapper" v-if="false">
               <div class="company-card-header" style="margin:auto;">
                   <h3>No company found </h3>
               </div>
           </div>
       </section>
        <!--       ADD COMPANY BUTTON ON THE BOTTOM RIGHT-->
       <section class="add_new_wrapper" v-if="can_add_company">
           <button class="btn_add_company" @click="show_company()" v-show="!modal_active">+ Company</button>
       </section>
        <!--  MODAL FOR ALL POP UPS     -->
       <section class="overlay-wrapper" v-if="modal_active">
        <!--     modal for adding new company-->
           <div class="company-modal-wrapper bounce" v-if="company_active">
               <div class="company-modal-header company-card-header">
                   <h3>Add New Company</h3>
                   <button @click="show_company()" class="btn-close">X</button>
               </div>
                   <form action="" method="POST" @submit.prevent="add_company($event)" class="add-company-form">
                       <input type="hidden" name="csrf_token" :value="csrf" >
                       <div class="vertical-form-group">
                           <label for="company_name">Company name:</label>
                           <input type="text" name="company_name" v-model="company_form.company_name" class="form-control">

                           <span class="is-invalid" role="alert" v-if="form_error.company_name">
                             <strong>{{form_error.company_name[0]}}</strong>
                         </span>
                       </div>

                        <div class="vertical-form-group">
                           <label for="company_email">Company email:</label>
                           <input type="email" name="company_email"  v-model = "company_form.company_email" class="form-control">
                           <span class="is-invalid" role="alert" v-if="form_error.company_email">
                             <strong>{{form_error.company_email[0]}}</strong>
                         </span>

                       </div>

                        <div class="vertical-form-group">
                           <label for="company_country">Company country:</label>
                           <input type="text" name="company_country" v-model="company_form.company_country" class="form-control">
                           <span class="is-invalid" role="alert" v-if="form_error.company_country">
                             <strong>{{form_error.company_country[0]}}</strong>
                         </span>
                       </div>

                       <div class="vertical-form-group">
                           <button role="button" type="submit" class="btn-center btn-update btn"> ADD COMPANY</button>
                       </div>
                   </form>
           </div>

        <!--      modal for updating company-->
           <div class="update-company-modal-wrapper bounce" v-if="update_company_active">
               <div class="company-modal-header company-card-header">
                   <h3>Update Company</h3>
                   <button @click="show_update_company()" class="btn-close">X</button>
               </div>
               <form action="" method="PATCH" @submit.prevent="update_company($event)" class="add-company-form">
                   <input type="hidden" name="csrf_token" :value="csrf" >
                   <div class="vertical-form-group">
                       <label for="company_name">Company name:</label>
                       <input type="text" name="company_name" id="company_name" v-model="company_form.company_name" class="form-control">

                       <span class="is-invalid" role="alert" v-if="form_error.company_name">
                             <strong>{{form_error.company_name[0]}}</strong>
                         </span>
                   </div>

                   <div class="vertical-form-group">
                       <label for="company_email">Company email:</label>
                       <input type="email" name="company_email" id="company_email" v-model = "company_form.company_email" class="form-control">
                       <span class="is-invalid" role="alert" v-if="form_error.company_email">
                             <strong>{{form_error.company_email[0]}}</strong>
                         </span>

                   </div>

                   <div class="vertical-form-group">
                       <label for="company_country">Company country:</label>
                       <input type="text" name="company_country" id="company_country" v-model="company_form.company_country" class="form-control">
                       <span class="is-invalid" role="alert" v-if="form_error.company_country">
                             <strong>{{form_error.company_country[0]}}</strong>
                         </span>
                   </div>

                   <div class="vertical-form-group">
                       <button role="button" type="submit" class="btn-center btn-update btn"> UPDATE COMPANY</button>
                   </div>
               </form>
           </div>
           <!--           result pop up-->
           <div class="result-wrapper bounce" v-if="form_result_active">
               <h3 v-bind:class="[form_response_status? `is-valid-result`:`is-invalid-result`,`result_message`]">{{form_result}}</h3>
               <button @click="reset_model()" class="btn btn-center btn-update">OK</button>
           </div>
       </section>
   </div>
</template>

<script>

    export default {
        props:['user_info'],
        created() {
           console.log(this.user_info)
            this.user_data = this.user_info
            },
            data(){
                return {
                    modal_active:false,
                    company_active:false,
                    update_company_active:false,
                    form_result_active:false,
                    form_response_status: null,
                    company_count:0,
                    to_update:0,
                    user_data: null,
                    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    company_form:{
                        company_name:null,
                        company_email:null,
                        company_country:null,
                    },
                    form_error: {},
                    form_result:null
                }
            },
        computed:{
          can_add_company: function(){
              return this.user_data.company.length <3;
          },
            user_company: {
                get: function() {
                    return this.user_data.company;
                },
                set:function(cm){
                    this.user_data = cm;
                }
            },
            _count: function(){
               return this.company_count +=1;
            }
        },
            methods:{
                show_model: function(){
                    this.modal_active = !this.modal_active
                },
                show_company: function(){
                    this.company_active = !this.modal_active
                    this.show_model()
                },
                show_update_company: function(to_update){
                    this.update_company_active = !this.update_company_active;
                    this.to_update = to_update.id;
                    this.company_form.company_name = to_update.company_name;
                    this.company_form.company_email = to_update.email;
                    this.company_form.company_country = to_update.country;
                    this.show_model()
                },
                show_form_result: function(){
                    this.form_result_active = !this.form_result_active
                },
                add_company: function (event){
                    console.log(this.company_form);
                    this.addCompanyAxios();
                },
                reset_model: function(){
                    this.show_form_result();
                    this.show_model()
                    this.modal_active = false;
                    this.company_active = false;
                    this.form_result_active = false;
                    this.update_company_active = false;
                    this.company_form.company_name = null;
                    this.company_form.company_email = null;
                    this.company_form.company_country = null;
                },

                addCompanyAxios: function(){
                     let companyInfo = this.company_form;
                    axios.post("/addcompany",companyInfo)
                        .then(response=>{
                            console.log(response)
                            this.form_result = response.data.message;
                            this.company_active = !this.modal_active
                            this.form_response_status = response.data.status;

                            if(this.form_response_status != false){
                                this.user_data = response.data.user_info
                            }
                            this.show_form_result()
                        })
                        .catch(err=>{
                            console.log(err.response)
                        const response = err.response;
                        const data = response.data
                        if(data.message == "The given data was invalid." || response.status ==422){
                            // the was a rule failure in the server
                            this.form_error = data.errors;
                        }
                        if(response.status == 405){
                            // method not allowed
                        }

                        //check if the return err is csrf mismatch,
                        // refresh the browser
                    })
                },
                delete_company:function(com_id){
                    if(confirm("are you sure? "))
                        this.deleteAxios(com_id)
                },
                deleteAxios: function(com_id){
                    axios.delete('/delete_home',{
                            data: { id: com_id }
                     })
                        .then(response =>{
                            console.log(response)
                            this.user_company = response.data.user_info
                        })
                        .catch(err =>{
                            console.log(err.response)
                            // check for possible errors
                        });
                },
                update_company: function(){
                    let companyInfo = this.company_form;
                    axios.patch(`/updatecompany/${this.to_update}`,companyInfo)
                        .then(response=>{
                            console.log(response)
                            this.form_result = response.data.message;
                            this.company_active = !this.modal_active
                            this.form_response_status = response.data.status;
                            if(this.form_response_status != false){
                                this.user_data = response.data.user_info
                            }
                            this.show_form_result()

                        })
                        .catch(err=>{
                            console.log(err.response)
                            const response = err.response;
                            const data = response.data
                            if(data.message == "The given data was invalid." || response.status ==422){
                                // the was a rule failure in the server
                                this.form_error = data.errors;
                            }
                            if(response.status == 405){
                                // method not allowed
                            }

                            //check if the return err is csrf mismatch,
                            // refresh the browser
                        })
                }

            }
    }

</script>
