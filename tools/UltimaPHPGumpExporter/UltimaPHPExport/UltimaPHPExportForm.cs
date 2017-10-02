using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Text;
using System.Windows.Forms;

namespace UltimaPHPExport
{
    public partial class UltimaPHPExportForm : Form
    {
        private UltimaPHPExport uphpExport;

        public UltimaPHPExportForm(UltimaPHPExport ultimaPHPExport)
        {
            this.InitializeComponent();
            this.uphpExport = ultimaPHPExport;
        }

        private void btn_Cancel_Click(object sender, EventArgs e)
        {
            base.Close();
        }

        private void btn_Export_Click(object sender, EventArgs e)
        {
            this.uphpExport.OnExportUltimaPHP(sender, e, (int)numX.Value, (int)numY.Value, chkNoDispose.Checked, chkNoClose.Checked, chkNoMove.Checked, txt_GumpName.Text);
        }
    }
}
