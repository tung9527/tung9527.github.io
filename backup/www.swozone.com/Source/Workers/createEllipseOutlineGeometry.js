/* This file is automatically rebuilt by the Cesium build process. */
define(['./Matrix2-70d3547e', './when-6655f883', './EllipseOutlineGeometry-d5fed8ab', './RuntimeError-5f205b85', './ComponentDatatype-579b2047', './WebGLConstants-cf1206a6', './GeometryOffsetAttribute-834a3c02', './Transforms-86620b15', './combine-1fd4d5cd', './EllipseGeometryLibrary-702a5b00', './GeometryAttribute-50934a13', './GeometryAttributes-2b1b6e3f', './IndexDatatype-e7458bc9'], (function (Matrix2, when, EllipseOutlineGeometry, RuntimeError, ComponentDatatype, WebGLConstants, GeometryOffsetAttribute, Transforms, combine, EllipseGeometryLibrary, GeometryAttribute, GeometryAttributes, IndexDatatype) { 'use strict';

  function createEllipseOutlineGeometry(ellipseGeometry, offset) {
    if (when.defined(offset)) {
      ellipseGeometry = EllipseOutlineGeometry.EllipseOutlineGeometry.unpack(ellipseGeometry, offset);
    }
    ellipseGeometry._center = Matrix2.Cartesian3.clone(ellipseGeometry._center);
    ellipseGeometry._ellipsoid = Matrix2.Ellipsoid.clone(ellipseGeometry._ellipsoid);
    return EllipseOutlineGeometry.EllipseOutlineGeometry.createGeometry(ellipseGeometry);
  }

  return createEllipseOutlineGeometry;

}));
