<script setup>
import { ref, onMounted } from "vue";
import * as echarts from "echarts";

const bar = ref(null);

onMounted(async () => {
  if (bar.value !== null) {
    const echart = echarts.init(bar.value);
    echart.setOption({
      grid: {
        containLabel: true,
      },
      xAxis: {
        type: "category",
        data: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
      },
      yAxis: {
        type: "value",
      },
      series: [
        {
          data: [120, 200, 150, 80, 70, 110, 130],
          type: "bar",
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
    <div ref="bar" class="w-full h-96 m-4 rounded-lg"></div>
  </div>
</template>
