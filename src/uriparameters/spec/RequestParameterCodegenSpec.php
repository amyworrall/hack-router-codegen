<?hh // strict
/*
 *  Copyright (c) 2016-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */

namespace Facebook\HackRouter;

abstract class RequestParameterCodegenSpec {
  const type TSpec = shape(
    'type' => string,
    'accessorSuffix' => string,
    'args' => ImmVector<UriParameterCodegenArgumentSpec>,
  );

  public abstract static function getGetterSpec(
    RequestParameter $param,
  ): self::TSpec;
}
