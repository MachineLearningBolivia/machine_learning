<script setup>
import { getSalesRequest } from "@/api/sale";
import { getProductRequest } from "@/api/product";
import { ref, onMounted } from "vue";
import * as echarts from "echarts";

const sales = ref([]);
const pie = ref(null);
const data = ref([
  { value: 1048, name: "Search Engine" },
  { value: 735, name: "Direct" },
  { value: 580, name: "Email" },
  { value: 484, name: "Union Ads" },
  { value: 300, name: "Video Ads" },
]);

onMounted(async () => {
  try {
    const res = await getSalesRequest();
    sales.value = res.data.data;
    console.log(sales.value);
  } catch (error) {
    toDisplayString.error("Error al cargar datos");
  }
  if (pie.value !== null) {
    const echart = echarts.init(pie.value);
    echart.setOption({
      grid: {
        containLabel: true,
      },
      title: {
        text: "Referer of a Website",
        subtext: "Fake Data",
        left: "center",
      },
      tooltip: {
        trigger: "item",
      },
      legend: {
        orient: "vertical",
        left: "left",
      },
      series: [
        {
          name: "Access From",
          type: "pie",
          radius: "50%",
          data: data.value,
          emphasis: {
            itemStyle: {
              shadowBlur: 10,
              shadowOffsetX: 0,
              shadowColor: "rgba(0, 0, 0, 0.5)",
            },
          },
        },
      ],
    });
  }
});
</script>

<template>
  <div
    class="flex flex-wrap justify-center items-center m-4 p-6 rounded-lg shadow-lg"
  >
    <div ref="pie" class="w-full h-96 m-4 rounded-lg"></div>
  </div>
</template>
