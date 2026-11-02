/* This file is automatically rebuilt by the Cesium build process. */
define(['./PrimitivePipeline-fca14751', './createTaskProcessorWorker', './Transforms-86620b15', './Matrix2-70d3547e', './RuntimeError-5f205b85', './when-6655f883', './ComponentDatatype-579b2047', './WebGLConstants-cf1206a6', './combine-1fd4d5cd', './GeometryAttribute-50934a13', './GeometryAttributes-2b1b6e3f', './GeometryPipeline-8fbe5c8c', './AttributeCompression-f5ecc6e8', './EncodedCartesian3-13464966', './IndexDatatype-e7458bc9', './IntersectionTests-0723f76f', './Plane-b8f2179f', './WebMercatorProjection-b5f86a40'], (function (PrimitivePipeline, createTaskProcessorWorker, Transforms, Matrix2, RuntimeError, when, ComponentDatatype, WebGLConstants, combine, GeometryAttribute, GeometryAttributes, GeometryPipeline, AttributeCompression, EncodedCartesian3, IndexDatatype, IntersectionTests, Plane, WebMercatorProjection) { 'use strict';

  function combineGeometry(packedParameters, transferableObjects) {
    var parameters = PrimitivePipeline.PrimitivePipeline.unpackCombineGeometryParameters(
      packedParameters
    );
    var results = PrimitivePipeline.PrimitivePipeline.combineGeometry(parameters);
    return PrimitivePipeline.PrimitivePipeline.packCombineGeometryResults(
      results,
      transferableObjects
    );
  }
  var combineGeometry$1 = createTaskProcessorWorker(combineGeometry);

  return combineGeometry$1;

}));
