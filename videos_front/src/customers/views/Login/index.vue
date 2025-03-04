<template>
  <div class="d-flex justify-content-center ">
    <div class="form-container col-md-3 right-panel-active   " id="container">
      <step-one @stepTwo="handleConfirm" :back_mobile=back_mobile v-if="status === 'step1'"/>
      <step-two @stepOne="handleBack" :mobile=mobile v-if="status === 'step2'"/>
    </div>
  </div>
</template>

<script setup>
import StepOne from "@/customers/views/Login/parts/stepOne.vue";
import StepTwo from "@/customers/views/Login/parts/stepTwo.vue";
import {$ref} from "unplugin-vue-macros/macros";
import {onMounted} from "vue";

let status = $ref("step1");
let mobile = $ref("")
let back_mobile = $ref("")

function handleConfirm(data) {
  mobile = data;
  status = "step2";
}
function handleBack(data) {
  back_mobile = data;
  status = "step1";
}
onMounted(() => {
  localStorage.removeItem('token');
  localStorage.removeItem('users');
  localStorage.removeItem('name');
});

</script>




