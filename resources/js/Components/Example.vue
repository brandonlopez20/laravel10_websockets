<template>
    <div id="chartdiv"></div>
</template>

<script>
import * as am5 from "@amcharts/amcharts5";
import * as am5map from "@amcharts/amcharts5/map";
import am5themes_Animated from "@amcharts/amcharts5/themes/Animated";
import am5geodata_guatemalaLow from "@amcharts/amcharts5-geodata/guatemalaLow";


export default {
    name: "Example",
    mounted() {
        /* Chart code */
        // Create root element
        let root = am5.Root.new("chartdiv");
        let colors = am5.ColorSet.new(root, {});

        // Set themes
        root.setThemes([am5themes_Animated.new(root)]);

        // Create the map chart
        let chart = root.container.children.push(
            am5map.MapChart.new(root, {
      
                projection: am5map.geoMercator(),
            })
        );

        // Create polygon series for the country map
        let guatemalaSeries = chart.series.push(
            am5map.MapPolygonSeries.new(root, {
                geoJSON: am5geodata_guatemalaLow,
            })
        );

        guatemalaSeries.mapPolygons.template.setAll({
            tooltipText: "{name}",
            interactive: true,
            fill: am5.color('#4997D0'),
            templateField: "polygonSettings",
        });

        guatemalaSeries.mapPolygons.template.states.create("hover", {
            fill: colors.getIndex(18),
        });

        guatemalaSeries.mapPolygons.template.events.on("click", (ev) => {
            let dataItem = ev.target.dataItem;
            let id = dataItem.get("id").toLowerCase().split("-").pop();
            let name = dataItem.dataContext.name;

                // Ocultar todos los departamentos
            guatemalaSeries.mapPolygons.each((polygon) => {
                if (polygon.dataItem !== dataItem) {
                    polygon.hide();
                }
            });
            
            // Mostrar el departamento clicleado
            dataItem.show();

            let zoomAnimation = guatemalaSeries.zoomToDataItem(dataItem);


            zoomAnimation.waitForStop(),
            console.log(dataItem);
        });

             chart.events.on("dblclick", () => {

                chart.goHome();

               guatemalaSeries.mapPolygons.each((polygon) => {
                    polygon.show();
                });
        });

    },
};
</script>

<style scoped>
#chartdiv {
    width: 100%;
    height: 80vh;
}
</style>
