import  { Suspense } from "react";

// eslint-disable-next-line react/display-name
const Loadable = (Component) => (props) =>
(
  <Suspense>
    <Component {...props} />
  </Suspense>
);

export default Loadable;
