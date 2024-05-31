<template>
    <div ref="chart" id="chart"></div>
</template>

<script>
import Highcharts from "highcharts";
import HighchartsMap from "highcharts/modules/map";
import mapData from "../helpers/gt-all.geo.json";

export default {
    mounted() {
        HighchartsMap(Highcharts);

        Highcharts.mapChart(this.$refs.chart, {
            chart: {
                map: mapData,
            },
            title: {
                text: "Mapa de Guatemala",
            },
            accessibility: {
                enabled: false,
            },
            series: [
                {
                    name: "Guatemala",
                    data: [
                        ["gt-av", 0], // Alta Verapaz
                        ["gt-bv", 1], // Baja Verapaz
                        ["gt-cm", 2], // Chimaltenango
                        ["gt-cq", 3], // Chiquimula
                        ["gt-pe", 4], // Petén
                        ["gt-gu", 5], // Guatemala
                        ["gt-hu", 6], // Huehuetenango
                        ["gt-iz", 7], // Izabal
                        ["gt-ja", 8], // Jalapa
                        ["gt-ju", 9], // Jutiapa
                        ["gt-qz", 10], // Quetzaltenango
                        ["gt-qc", 11], // Quiché
                        ["gt-re", 12], // Retalhuleu
                        ["gt-sa", 13], // Sacatepéquez
                        ["gt-sm", 14], // San Marcos
                        ["gt-sr", 15], // Santa Rosa
                        ["gt-so", 16], // Sololá
                        ["gt-su", 17], // Suchitepéquez
                        ["gt-to", 18], // Totonicapán
                        ["gt-za", 19], // Zacapa
                        ["gt-es", 20], // Escuintla
                        ["gt-pr", 21], // El Progreso
                    ],
                    states: {
                        hover: {
                            color: "#a4edba",
                        },
                    },
                    dataLabels: {
                        enabled: true,
                        format: "{point.name}",
                    },
                    point: {
                        events: {
                            click: function () {
                                this.zoomTo()
                                console.log(this.name);
                            },
                        },
                      
                    },
                },
            ],
        });
    },
};
</script>
<style scoped>
#chart{
  width: 100%;
  height: 700px;
}
</style>