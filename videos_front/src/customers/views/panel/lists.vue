<template>
  <section class="container mx-auto p-5 bg-white shadow-lg rounded-xl mt-5" style="direction: rtl">
    <div class="d-flex justify-content-end">
      <router-link to="/panel/dashboard" class="title btn btn-outline-primary  ">ایجاد لینک ها</router-link>
    </div>
    <br>
    <div class="mb-4 flex justify-between items-center">
      <h2 class="text-xl font-semibold">لیست لینک‌ها</h2>
      <input
        v-model="searchQuery"
        type="text"
        placeholder="جستجو..."
        class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-1/3"
      />
    </div>
    <div class="overflow-x-auto">
      <table class="w-full table-auto border-collapse border border-gray-300 rounded-lg text-gray-700">
        <thead>
        <tr class="bg-blue-100 text-blue-900">
          <th class="border p-3">شناسه</th>
          <th class="border p-3">عنوان</th>
          <th class="border p-3">توضیحات</th>
          <th class="border p-3">عملیات</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(link, index) in filteredLinks" :key="index" class="hover:bg-gray-50">
          <td class="border p-3 text-center">{{ link.id }}</td>
          <td class="border p-3">{{ link.title }}</td>
          <td class="border p-3">{{ link.text.substring(4,80) }}</td>
          <td class="border p-3 text-center">
            <button class="btn btn-outline-dark text-success"
                    @click="copyToClipboard(`https://videos.holooacademy.com/${link.uid}`)">
              کپی لینک
            </button>
            <router-link :to="`/videos/${link.uid}`"
                         class="btn btn-outline-dark  ">
              مشاهد ویدیو
            </router-link>
            <button @click="btn_delete(link.id)" type="button"
                    class="btn-outline-dark btn text-danger">
              حذف
            </button>

          </td>
        </tr>
        <tr v-if="filteredLinks.length === 0">
          <td colspan="6" class="text-center py-4 text-gray-500">نتیجه‌ای یافت نشد</td>
        </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>

<script setup>
import {ref, computed, onMounted} from "vue";
import axios from "axios";
import { useToast } from 'vue-toastification';
import {myErrors} from "@/commons/helpers/errors.js";
import {$ref} from "unplugin-vue-macros/macros";
let toast = useToast();
let listLinks = $ref([]);
const searchQuery = ref("");
const url = "links";

async function fetchLinks() {
  try {
    const response = await axios.get(url);
    listLinks = response.data.data;
  } catch (error) {
    toast.error("خطا در دریافت داده‌ها");
    console.error(error);
  }
}
async function btn_delete(id) {
  try {
    const response = await axios.delete(`${url}/${id}`);
    toast.success(response.data.message);
    await fetchLinks()
  } catch (error) {
    await fetchLinks()
    myErrors(error)
  }
}

async function copyToClipboard(url) {
  try {
    await navigator.clipboard.writeText(url);
    toast.success("لینک کپی شد!"); // پیام درست
  } catch (err) {
    toast.error("مشکلی در کپی لینک وجود دارد!");
    console.error(err);
  }
}



const filteredLinks = computed(() => {
  if (!searchQuery.value.trim()) return listLinks;
  return listLinks.filter(link => {
    const searchLower = searchQuery.value.toLowerCase();
    return (
      (link.title && link.title.toLowerCase().includes(searchLower)) ||
      (link.description && link.description.toLowerCase().includes(searchLower))
    );
  });
});

onMounted(() => {
  fetchLinks();
});
</script>
