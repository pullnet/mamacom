// WARNING
//
// This file has been generated automatically by Visual Studio from the outlets and
// actions declared in your storyboard file.
// Manual changes to this file will not be maintained.
//
using Foundation;
using System;
using System.CodeDom.Compiler;

namespace mamacom_ios
{
    [Register ("ViewController")]
    partial class ViewController
    {
        [Outlet]
        [GeneratedCode ("iOS Designer", "1.0")]
        UIKit.UIButton button { get; set; }

        [Outlet]
        [GeneratedCode ("iOS Designer", "1.0")]
        UIKit.UIButton button_02 { get; set; }

        [Outlet]
        [GeneratedCode ("iOS Designer", "1.0")]
        UIKit.UILabel label { get; set; }

        [Action ("buttonClick:")]
        [GeneratedCode ("iOS Designer", "1.0")]
        partial void buttonClick (UIKit.UIButton sender);

        void ReleaseDesignerOutlets ()
        {
            if (button != null) {
                button.Dispose ();
                button = null;
            }

            if (button_02 != null) {
                button_02.Dispose ();
                button_02 = null;
            }

            if (label != null) {
                label.Dispose ();
                label = null;
            }
        }
    }
}