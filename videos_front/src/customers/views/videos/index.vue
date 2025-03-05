<template>
  <div
    v-if="!route.params.uid || route.params.uid === 'undefined'"
    class="min-h-screen flex items-center justify-center bg-gray-100"
    >
    <div class=" form-control card p-4 glassmorphism text-center animate-fade-in">
      <h2 class="text-lg font-semibold text-gray-700">ویدیو برای نمایش وجود ندارد</h2>
      <p class="text-gray-500 mt-2">لطفاً لینک صحیح را بررسی کنید.</p>
    </div>
  </div>

  <div v-else
    class="min-h-screen d-flex flex-col bg-cover px-4 py-5"
    :style="{ backgroundImage: `url('@/customers/assets/images/background.jpg')` }"
  >
    <div class="w-full flex justify-center">
      <div class="w-full max-w-4xl aspect-w-9 aspect-h-16 sm:aspect-w-16 sm:aspect-h-9 rounded overflow-hidden">
        <video
          v-if="videos.url"
          id="videoPlayer"
          class="video-js vjs-default-skin  w-full  rounded-t-lg"
          controls
          poster="@/customers/assets/images/backgroudn.jpg"
          preload="auto"
        >
          <source :src="videos.url" type="video/mp4">
          مرورگر شما از تگ ویدیو پشتیبانی نمی‌کند.
        </video>
        <!-- لودینگ -->
        <div v-else class="flex items-center justify-center bg-gray-200 rounded p-5 h-full">
          <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-primary"></div>
        </div>
      </div>
    </div>

    <div class="container bg-white shadow-lg rounded-lg p-6 w-full max-w-4xl mt-4 flex flex-col items-center">
      <h2 class="text-center font-bold text-xl md:text-2xl mb-4 avatar-title ">
        {{ videos.title || "عنوان ویدیو" }}
      </h2>
      <div class="bg-gray-100 p-3 rounded mb-4 w-full"  style=" overflow-y: scroll;  height: 220px;">
        <span class="font-semibold text-sm-center md:text-base d-flex text-center">{{ videos.text || "عنوان توضیحات" }}</span>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import { useToast } from 'vue-toastification';
import { myErrors } from '@/commons/helpers/errors.js';

const toast = useToast();
const route = useRoute();
const videos = ref({});

const fetchLinks = async () => {
  try {
    const response = await axios.get(`videos/${route.params.uid}`);
    videos.value = response.data.data;

    setTimeout(() => {
      if (videos.value.url) {
        videojs("#videoPlayer", {
          controls: true,
        });
      }
    }, 500);
  } catch (error) {
    toast.error("خطا در دریافت داده‌ها");
  }
};

onMounted(fetchLinks);
</script>

<style scoped>
.bg-cover {
  background-size: cover;
  background-position: center;
}
</style>
