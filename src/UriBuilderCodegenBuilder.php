<?hh // strict
/*
 *  Copyright (c) 2016, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace Facebook\HackRouter;

use \Facebook\HackCodegen as cg;

final class UriBuilderCodegenBuilder {
  private cg\CodegenGeneratedFrom $generatedFrom;
  public function __construct(
    private classname<UriBuilderCodegenBase> $base,
    private classname<UriParameterCodegenBuilder> $parameterBuilder,
  ) {
    $this->generatedFrom = cg\codegen_generated_from_script();
  }

  public function renderToFile(
    string $path,
    classname<HasUriPattern> $controller,
    ?string $namespace,
    string $class,
  ): cg\CodegenFileResult {
    return $this->getCodegenFile($path, $controller, $namespace, $class)
      ->save();
  }

  private function getCodegenFile(
    string $path,
    classname<HasUriPattern> $controller,
    ?string $namespace,
    string $classname,
  ): cg\CodegenFile {
    $file = cg\codegen_file($path)
      ->setFileType(cg\CodegenFileType::HACK_STRICT)
      ->setGeneratedFrom($this->generatedFrom)
      ->addClass($this->getUriBuilderCodegenClass($controller, $classname));
    if ($namespace !== null) {
      $file->setNamespace($namespace);
    }
    return $file;
  }

  private function getUriBuilderCodegenClass(
    classname<HasUriPattern> $controller,
    string $class_name,
  ): cg\CodegenClass {
    $param_builder = $this->parameterBuilder;

    $common = cg\codegen_class($class_name)
      ->addConst(
        sprintf("classname<\\%s> CONTROLLER", HasUriPattern::class),
        sprintf("\\%s::class", $controller),
        /* comment = */ null,
        cg\HackBuilderValues::LITERAL,
      )
      ->setIsFinal(true)
      ->setExtends("\\".$this->base);

    $pattern = $controller::getUriPattern();
    foreach ($pattern->getParameters() as $parameter) {
      $common->addMethod($param_builder::getSetter($parameter));
    }

    return $common;
  }
}