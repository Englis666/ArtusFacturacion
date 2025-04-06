# Base de datos
 - Aqui se tendra toca la documentacion de la base de datos, normalmente se escribia el funcionamiento de las tablas que contienen y las consultas para futuros mantenimientos, ademas se escribira como esta la estructura de relaciones de las tablas.

# Relaciones

    #Tabla	            # Relacionada con	        Tipo de Relación
    productos	          categorias,proveedores	    1:N
    stock_productos     	productos	                1:1
    inversiones_productos	productos               	1:N
    gastos_categorias	    categorias	                1:N
    ventas	clientes,       usuarios	                1:N
    detalle_venta	       ventas,productos	            N:M
    historial_ventas	    ventas	                    1:N
    cierre_mes	          ventas, gastos_mensuales	    1:N
    reportes	          Generales	                      -

# Tablas

    #Atributos


# Consultas



# INDEX DE LA BASE DE DATOS
 - Posiblmenete agregue esto a la base de datos para una mejor optimizaacion en consultas y rendimiento
            CREATE INDEX idx_documento ON clientes(documento);

            CREATE INDEX idx_nombre_producto ON productos(nombre);
            CREATE INDEX idx_categoria_producto ON productos(id_categoria);
            CREATE INDEX idx_proveedor_producto ON productos(id_proveedor);

            CREATE INDEX idx_cantidad_stock ON stock_productos(cantidad_disponible);

            CREATE INDEX idx_fecha_inversion ON inversiones_productos(fecha);
            CREATE INDEX idx_producto_inversion ON inversiones_productos(id_producto);

            CREATE INDEX idx_categoria_gasto ON gastos_categorias(id_categoria);
            CREATE INDEX idx_fecha_gasto_categoria ON gastos_categorias(fecha);

            CREATE INDEX idx_fecha_gasto_mensual ON gastos_mensuales(fecha);

            CREATE INDEX idx_fecha_venta ON ventas(fecha);
            CREATE INDEX idx_cliente_venta ON ventas(id_cliente);
            CREATE INDEX idx_usuario_venta ON ventas(id_usuario);

            CREATE INDEX idx_venta_detalle ON detalle_venta(id_venta);
            CREATE INDEX idx_producto_detalle ON detalle_venta(id_producto);

            CREATE INDEX idx_fecha_historial ON historial_ventas(fecha);
            CREATE INDEX idx_venta_historial ON historial_ventas(id_venta);

            CREATE INDEX idx_cierre_mes ON cierre_mes(mes, año);

            CREATE INDEX idx_tipo_reporte ON reportes(tipo_reporte);
            CREATE INDEX idx_fecha_reporte ON reportes(fecha_generacion);
